<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Logging\TestDox;

use function array_key_exists;
use function array_keys;
use function array_map;
use function array_pop;
use function array_values;
use function assert;
use function class_exists;
use function explode;
use function gettype;
use function implode;
use function in_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_numeric;
use function is_object;
use function is_scalar;
use function method_exists;
use function ord;
use function preg_quote;
use function preg_replace;
use function range;
use function sprintf;
use function str_contains;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strlen;
use function strtolower;
use function strtoupper;
use function substr;
use function trim;
use PHPUnit\Framework\TestCase;
use PHPUnit\Metadata\Parser\Registry as MetadataRegistry;
use PHPUnit\Metadata\TestDox;
use PHPUnit\Util\Color;
use ReflectionMethod;
use ReflectionObject;
use SebastianBergmann\Exporter\Exporter;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class NamePrettifier
{
    /**
     * @psalm-var list<string>
     */
    private static array $strings = [];

    /**
     * @psalm-param class-string $className
     */
    public function prettifyTestClassName(string $className): string
    {
        if (class_exists($className)) {
            $classLevelTestDox = MetadataRegistry::parser()->forClass($className)->isTestDox();

            if ($classLevelTestDox->isNotEmpty()) {
                $classLevelTestDox = $classLevelTestDox->asArray()[0];

                assert($classLevelTestDox instanceof TestDox);

                return $classLevelTestDox->text();
            }
        }

        $parts     = explode('\\', $className);
        $className = array_pop($parts);

        if (str_ends_with($className, 'Test')) {
            $className = substr($className, 0, strlen($className) - strlen('Test'));
        }

        if (str_starts_with($className, 'Tests')) {
            $className = substr($className, strlen('Tests'));
        } elseif (str_starts_with($className, 'Test')) {
            $className = substr($className, strlen('Test'));
        }

        if (empty($className)) {
            $className = 'UnnamedTests';
        }

        if (!empty($parts)) {
            $parts[]            = $className;
            $fullyQualifiedName = implode('\\', $parts);
        } else {
            $fullyQualifiedName = $className;
        }

        $result = preg_replace('/(?<=[[:lower:]])(?=[[:upper:]])/u', ' ', $className);

        if ($fullyQualifiedName !== $className) {
            return $result . ' (' . $fullyQualifiedName . ')';
        }

        return $result;
    }

    public function prettifyTestMethodName(string $name): string
    {
        $buffer = '';

        if ($name === '') {
            return $buffer;
        }

        $string = (string) preg_replace('#\d+$#', '', $name, -1, $count);

        if (in_array($string, self::$strings, true)) {
            $name = $string;
        } elseif ($count === 0) {
            self::$strings[] = $string;
        }

        if (str_starts_with($name, 'test_')) {
            $name = substr($name, 5);
        } elseif (str_starts_with($name, 'test')) {
            $name = substr($name, 4);
        }

        if ($name === '') {
            return $buffer;
        }

        $name[0] = strtoupper($name[0]);

        if (str_contains($name, '_')) {
            return trim(str_replace('_', ' ', $name));
        }

        $wasNumeric = false;

        foreach (range(0, strlen($name) - 1) as $i) {
            if ($i > 0 && ord($name[$i]) >= 65 && ord($name[$i]) <= 90) {
                $buffer .= ' ' . strtolower($name[$i]);
            } else {
                $isNumeric = is_numeric($name[$i]);

                if (!$wasNumeric && $isNumeric) {
                    $buffer .= ' ';
                    $wasNumeric = true;
                }

                if ($wasNumeric && !$isNumeric) {
                    $wasNumeric = false;
                }

                $buffer .= $name[$i];
            }
        }

        return $buffer;
    }

    public function prettifyTestCase(TestCase $test, bool $colorize): string
    {
        $annotationWithPlaceholders = false;
        $methodLevelTestDox         = MetadataRegistry::parser()->forMethod($test::class, $test->name())->isTestDox()->isMethodLevel();

        if ($methodLevelTestDox->isNotEmpty()) {
            $methodLevelTestDox = $methodLevelTestDox->asArray()[0];

            assert($methodLevelTestDox instanceof TestDox);

            $result = $methodLevelTestDox->text();

            if (str_contains($result, '$')) {
                $annotation   = $result;
                $providedData = $this->mapTestMethodParameterNamesToProvidedDataValues($test, $colorize);

                $variables = array_map(
                    static fn (string $variable): string => sprintf(
                        '/%s(?=\b)/',
                        preg_quote($variable, '/')
                    ),
                    array_keys($providedData)
                );

                $result = trim(preg_replace($variables, $providedData, $annotation));

                $annotationWithPlaceholders = true;
            }
        } else {
            $result = $this->prettifyTestMethodName($test->name());
        }

        if (!$annotationWithPlaceholders && $test->usesDataProvider()) {
            $result .= $this->prettifyDataSet($test, $colorize);
        }

        return $result;
    }

    public function prettifyDataSet(TestCase $test, bool $colorize): string
    {
        if (!$colorize) {
            return $test->dataSetAsString();
        }

        if (is_int($test->dataName())) {
            return Color::dim(' with data set ') . Color::colorize('fg-cyan', (string) $test->dataName());
        }

        return Color::dim(' with ') . Color::colorize('fg-cyan', Color::visualizeWhitespace($test->dataName()));
    }

    private function mapTestMethodParameterNamesToProvidedDataValues(TestCase $test, bool $colorize): array
    {
        assert(method_exists($test, $test->name()));

        /** @noinspection PhpUnhandledExceptionInspection */
        $reflector = new ReflectionMethod($test::class, $test->name());

        $providedData       = [];
        $providedDataValues = array_values($test->providedData());
        $i                  = 0;

        $providedData['$_dataName'] = $test->dataName();

        foreach ($reflector->getParameters() as $parameter) {
            if (!array_key_exists($i, $providedDataValues) && $parameter->isDefaultValueAvailable()) {
                $providedDataValues[$i] = $parameter->getDefaultValue();
            }

            $value = $providedDataValues[$i++] ?? null;

            if (is_object($value)) {
                $reflector = new ReflectionObject($value);

                if ($reflector->isEnum()) {
                    $value = $value->value;
                } elseif ($reflector->hasMethod('__toString')) {
                    $value = (string) $value;
                } else {
                    $value = $value::class;
                }
            }

            if (!is_scalar($value)) {
                $value = gettype($value);
            }

            if (is_bool($value) || is_int($value) || is_float($value)) {
                $value = (new Exporter)->export($value);
            }

            if ($value === '') {
                if ($colorize) {
                    $value = Color::colorize('dim,underlined', 'empty');
                } else {
                    $value = "''";
                }
            }

            $providedData['$' . $parameter->getName()] = $value;
        }

        if ($colorize) {
            $providedData = array_map(static fn ($value) => Color::colorize('fg-cyan', Color::visualizeWhitespace((string) $value, true)), $providedData);
        }

        return $providedData;
    }
}
