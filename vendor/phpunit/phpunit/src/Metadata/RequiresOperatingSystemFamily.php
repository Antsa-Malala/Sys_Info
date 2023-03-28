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
final class RequiresOperatingSystemFamily extends Metadata
{
    private readonly string $operatingSystemFamily;

    protected function __construct(int $level, string $operatingSystemFamily)
    {
        parent::__construct($level);

        $this->operatingSystemFamily = $operatingSystemFamily;
    }

    public function isRequiresOperatingSystemFamily(): bool
    {
        return true;
    }

    public function operatingSystemFamily(): string
    {
        return $this->operatingSystemFamily;
    }
}
