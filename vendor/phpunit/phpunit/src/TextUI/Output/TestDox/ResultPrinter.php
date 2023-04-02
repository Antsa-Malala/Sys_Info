<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TextUI\Output\TestDox;

use const PHP_EOL;
use function array_map;
use function assert;
use function count;
use function explode;
use function implode;
use function preg_match;
use function preg_split;
use function rtrim;
use function sprintf;
use function str_starts_with;
use function trim;
use PHPUnit\Event\Code\Throwable;
use PHPUnit\Event\TestData\NoDataSetFromDataProviderException;
use PHPUnit\Framework\TestStatus\TestStatus;
use PHPUnit\Logging\TestDox\TestResult as TestDoxTestResult;
use PHPUnit\Logging\TestDox\TestResultCollection;
use PHPUnit\TestRunner\TestResult\TestResult;
use PHPUnit\TextUI\Output\Printer;
use PHPUnit\Util\Color;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ResultPrinter
{
    private readonly Printer $printer;
    private readonly bool $colors;

    public function __construct(Printer $printer, bool $colors)
    {
        $this->printer = $printer;
        $this->colors  = $colors;
    }

    /**
     * @psalm-param array<string, TestResultCollection> $tests
     */
    public function print(array $tests, TestResult $result): void
    {
        foreach ($tests as $prettifiedClassName => $_tests) {
            $this->printPrettifiedClassName($prettifiedClassName);

            foreach ($_tests as $test) {
                $this->printTestResult($test);
            }

            $this->printer->print(PHP_EOL);
        }

        $this->printTestRunnerWarningsAndDeprecations($result);
    }

    public function flush(): void
    {
        $this->printer->flush();
    }

    /**
     * @psalm-param string $prettifiedClassName
     */
    private function printPrettifiedClassName(string $prettifiedClassName): void
    {
        $buffer = $prettifiedClassName;

        if ($this->colors) {
            $buffer = Color::colorizeTextBox('underlined', $buffer);
        }

        $this->printer->print($buffer . PHP_EOL);
    }

    /**
     * @throws NoDataSetFromDataProviderException
     */
    private function printTestResult(TestDoxTestResult $test): void
    {
        $this->printTestResultHeader($test);
        $this->printTestResultBody($test);
    }

    /**
     * @throws NoDataSetFromDataProviderException
     */
    private function printTestResultHeader(TestDoxTestResult $test): void
    {
        $buffer = ' ' . $this->symbolFor($test->status()) . ' ';

        if ($this->colors) {
            $this->printer->print(
                Color::colorizeTextBox(
                    $this->colorFor($test->status()),
                    $buffer
                )
            );
        } else {
            $this->printer->print($buffer);
        }

        $this->printer->print($test->test()->testDox()->prettifiedMethodName($this->colors) . PHP_EOL);
    }

    private function printTestResultBody(TestDoxTestResult $test): void
    {
        if ($test->status()->isSuccess()) {
            return;
        }

        if (!$test->hasThrowable()) {
            return;
        }

        $this->printTestResultBodyStart($test);
        $this->printThrowable($test);
        $this->printTestResultBodyEnd($test);
    }

    private function printTestResultBodyStart(TestDoxTestResult $test): void
    {
        $this->printer->print(
            $this->prefixLines(
                $this->prefixFor('start', $test->status()),
                ''
            )
        );

        $this->printer->print(PHP_EOL);
    }

    private function printTestResultBodyEnd(TestDoxTestResult $test): void
    {
        $this->printer->print(PHP_EOL);

        $this->printer->print(
            $this->prefixLines(
                $this->prefixFor('last', $test->status()),
                ''
            )
        );

        $this->printer->print(PHP_EOL);
    }

    private function printThrowable(TestDoxTestResult $test): void
    {
        $throwable = $test->throwable();

        assert($throwable instanceof Throwable);

        $message    = trim($throwable->description());
        $stackTrace = $this->formatStackTrace($throwable->stackTrace());
        $diff       = '';

        if (!empty($message) && $this->colors) {
            ['message' => $message, 'diff' => $diff] = $this->colorizeMessageAndDiff(
                $message,
                $this->messageColorFor($test->status())
            );
        }

        if (!empty($message)) {
            $this->printer->print(
                $this->prefixLines(
                    $this->prefixFor('message', $test->status()),
                    $message
                )
            );

            $this->printer->print(PHP_EOL);
        }

        if (!empty($diff)) {
            $this->printer->print(
                $this->prefixLines(
                    $this->prefixFor('diff', $test->status()),
                    $diff
                )
            );

            $this->printer->print(PHP_EOL);
        }

        if (!empty($stackTrace)) {
            if (!empty($message) || !empty($diff)) {
                $prefix = $this->prefixFor('default', $test->status());
            } else {
                $prefix = $this->prefixFor('trace', $test->status());
            }

            $this->printer->print(
                $this->prefixLines($prefix, PHP_EOL . $stackTrace)
            );
        }
    }

    /**
     * @psalm-return array{message: string, diff: string}
     */
    private function colorizeMessageAndDiff(string $buffer, string $style): array
    {
        $lines      = $buffer ? array_map('\rtrim', explode(PHP_EOL, $buffer)) : [];
        $message    = [];
        $diff       = [];
        $insideDiff = false;

        foreach ($lines as $line) {
            if ($line === '--- Expected') {
                $insideDiff = true;
            }

            if (!$insideDiff) {
                $message[] = $line;
            } else {
                if (str_starts_with($line, '-')) {
                    $line = Color::colorize('fg-red', Color::visualizeWhitespace($line, true));
                } elseif (str_starts_with($line, '+')) {
                    $line = Color::colorize('fg-green', Color::visualizeWhitespace($line, true));
                } elseif ($line === '@@ @@') {
                    $line = Color::colorize('fg-cyan', $line);
                }

                $diff[] = $line;
            }
        }

        $message = implode(PHP_EOL, $message);
        $diff    = implode(PHP_EOL, $diff);

        if (!empty($message)) {
            $message = Color::colorizeTextBox($style, $message);
        }

        return [
            'message' => $message,
            'diff'    => $diff,
        ];
    }

    private function formatStackTrace(string $stackTrace): string
    {
        if (!$this->colors) {
            return rtrim($stackTrace);
        }

        $lines        = [];
        $previousPath = '';

        foreach (explode(PHP_EOL, $stackTrace) as $line) {
            if (preg_match('/^(.*):(\d+)$/', $line, $matches)) {
                $lines[]      = Color::colorizePath($matches[1], $previousPath) . Color::dim(':') . Color::colorize('fg-blue', $matches[2]) . "\n";
                $previousPath = $matches[1];

                continue;
            }

            $lines[]      = $line;
            $previousPath = '';
        }

        return rtrim(implode('', $lines));
    }

    private function prefixLines(string $prefix, string $message): string
    {
        return implode(
            PHP_EOL,
            array_map(
                static fn (string $line) => '   ' . $prefix . ($line ? ' ' . $line : ''),
                preg_split('/\r\n|\r|\n/', $message)
            )
        );
    }

    /**
     * @psalm-param 'default'|'start'|'message'|'diff'|'trace'|'last' $type
     */
    private function prefixFor(string $type, TestStatus $status): string
    {
        if (!$this->colors) {
            return '│';
        }

        return Color::colorize(
            $this->colorFor($status),
            match ($type) {
                'default' => '│',
                'start'   => '┐',
                'message' => '├',
                'diff'    => '┊',
                'trace'   => '╵',
                'last'    => '┴'
            }
        );
    }

    private function colorFor(TestStatus $status): string
    {
        if ($status->isSuccess()) {
            return 'fg-green';
        }

        if ($status->isError()) {
            return 'fg-yellow';
        }

        if ($status->isFailure()) {
            return 'fg-red';
        }

        if ($status->isSkipped()) {
            return 'fg-cyan';
        }

        if ($status->isRisky() || $status->isIncomplete() || $status->isWarning()) {
            return 'fg-yellow';
        }

        return 'fg-blue';
    }

    private function messageColorFor(TestStatus $status): string
    {
        if ($status->isSuccess()) {
            return '';
        }

        if ($status->isError()) {
            return 'bg-yellow,fg-black';
        }

        if ($status->isFailure()) {
            return 'bg-red,fg-white';
        }

        if ($status->isSkipped()) {
            return 'fg-cyan';
        }

        if ($status->isRisky() || $status->isIncomplete() || $status->isWarning()) {
            return 'fg-yellow';
        }

        return 'fg-white,bg-blue';
    }

    private function symbolFor(TestStatus $status): string
    {
        if ($status->isSuccess()) {
            return '✔';
        }

        if ($status->isError() || $status->isFailure()) {
            return '✘';
        }

        if ($status->isSkipped()) {
            return '↩';
        }

        if ($status->isRisky()) {
            return '☢';
        }

        if ($status->isIncomplete()) {
            return '∅';
        }

        if ($status->isWarning()) {
            return '⚠';
        }

        return '?';
    }

    private function printTestRunnerWarningsAndDeprecations(TestResult $result): void
    {
        if (!$result->hasTestRunnerTriggeredWarningEvents() &&
            !$result->hasTestRunnerTriggeredDeprecationEvents()) {
            return;
        }

        if ($result->hasTestRunnerTriggeredWarningEvents()) {
            $warnings = [];

            foreach ($result->testRunnerTriggeredWarningEvents() as $warning) {
                $warnings[] = $warning->message();
            }

            $this->printList($warnings, 'test runner warning');
        }

        if ($result->hasTestRunnerTriggeredDeprecationEvents()) {
            $deprecations = [];

            foreach ($result->testRunnerTriggeredWarningEvents() as $deprecation) {
                $deprecations[] = $deprecation->message();
            }

            $this->printList($deprecations, 'test runner deprecation');
        }
    }

    /**
     * @psalm-param list<string> $elements
     */
    private function printList(array $elements, string $type): void
    {
        $count = count($elements);

        $this->printer->print(
            sprintf(
                "There %s %d %s%s:\n\n",
                ($count === 1) ? 'was' : 'were',
                $count,
                $type,
                ($count === 1) ? '' : 's'
            )
        );

        $i = 1;

        foreach ($elements as $element) {
            $this->printListElement($i++, $element);
        }

        $this->printer->print("\n");
    }

    private function printListElement(int $number, string $text): void
    {
        $this->printer->print(
            sprintf(
                "%s%d) %s\n",
                $number > 1 ? "\n" : '',
                $number,
                trim($text),
            )
        );
    }
}
