# WilyCode Filter

[![PHP 8.4+](https://img.shields.io/badge/PHP-8.4%2B-777BB4)](https://www.php.net/)
[![MIT License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Tests](https://github.com/wilycode/filter/actions/workflows/tests.yml/badge.svg)](https://github.com/wilycode/filter/actions/workflows/tests.yml)

A minimal, framework-independent contract for normalizing PHP values. This package **defines an interface only**, keeping applications independent of specific filters.

> ### WilyCode PHP Ecosystem
>
> Part of **[WilyCode](https://github.com/wilycode/wilycode)** — independent PHP libraries with their own repositories, releases and Composer installation.
>
> **[Explore the WilyCode PHP Ecosystem →](https://github.com/wilycode/wilycode)**

## Contents

- [Installation](#installation)
- [Implement a filter](#implement-a-filter)
- [API reference](#api-reference)
- [Related packages](#related-packages)
- [Development](#development)
- [License](#license)

## Installation

Requires PHP **8.4+**. There are no additional runtime dependencies.

```bash
composer require wilycode/filter
```

## Implement a filter

```php
<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use WilyCode\Filter\FilterInterface;

final class UppercasePrefixFilter implements FilterInterface
{
    public function getFilteredValue(mixed $value): mixed
    {
        if (!is_string($value)) {
            return $value;
        }

        return 'PREFIX-' . strtoupper($value);
    }
}

$filter = new UppercasePrefixFilter();
$filter->getFilteredValue('hello'); // 'PREFIX-HELLO'
$filter->getFilteredValue(null);    // null
```

`FilterInterface` has a single method, `getFilteredValue(mixed $value): mixed`. Its return type deliberately allows normalization to change the input type, such as converting a form string to an integer or `null`. Decide how to handle non-matching input types in your own implementation.

## API reference

| API | Purpose |
| --- | --- |
| `FilterInterface::getFilteredValue(mixed $value): mixed` | Return a normalized value. |

The contract has no filtering pipeline, validation side effects or built-in error reporting. Consumers choose when to invoke a filter.

## Related packages

- [`wilycode/filters`](https://github.com/wilycode/filters) — ready-made trim, null, scalar type, string case, array-item and slug filters.
- [`wilycode/form`](https://github.com/wilycode/form) — form fields and nested groups that consume filters and validators.

## Development

```bash
composer install
composer validate --strict
composer test
```

The GitHub Actions workflow tests PHP 8.4 and PHP 8.5. Source tests are excluded from Composer distribution archives.

## License

MIT © 2026 Simon Piter. See [LICENSE](LICENSE).
