<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Metadata;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 *
 * @psalm-immutable
 */
final class RequiresFunction extends Metadata
{
    private readonly string $functionName;

    protected function __construct(int $level, string $functionName)
    {
        parent::__construct($level);

        $this->functionName = $functionName;
    }

    public function isRequiresFunction(): bool
    {
        return true;
    }

    public function functionName(): string
    {
        return $this->functionName;
    }
}
