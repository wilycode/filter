<?php

declare(strict_types=1);

namespace WilyCode\Filter\Tests;

use PHPUnit\Framework\TestCase;
use WilyCode\Filter\FilterInterface;

final class FilterInterfaceTest extends TestCase
{
    public function testCustomFilterCanImplementTheContractWithoutFormDependency(): void
    {
        $filter = new class implements FilterInterface {
            public function getFilteredValue(mixed $value): mixed
            {
                return is_string($value) ? trim($value) : $value;
            }
        };

        self::assertSame('value', $filter->getFilteredValue(' value '));
        self::assertSame(10, $filter->getFilteredValue(10));
    }

    public function testCustomFilterCanChangeTypeAndPreserveOtherValues(): void
    {
        $filter = new class implements FilterInterface {
            public function getFilteredValue(mixed $value): mixed
            {
                return is_string($value) && is_numeric($value) ? (int) $value : $value;
            }
        };

        self::assertSame(42, $filter->getFilteredValue('42'));
        self::assertSame(null, $filter->getFilteredValue(null));
        self::assertSame([], $filter->getFilteredValue([]));
        self::assertSame('forty-two', $filter->getFilteredValue('forty-two'));
    }
}
