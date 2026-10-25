<?php

declare(strict_types=1);

namespace WilyCode\Filter;

interface FilterInterface
{
    public function getFilteredValue(mixed $value): mixed;
}
