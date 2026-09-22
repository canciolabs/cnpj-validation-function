# CNPJ Validation Function

[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-%5E8.5-777bb4.svg)](https://www.php.net/)

A lightweight, dependency-free PHP library for validating Brazilian CNPJ registration numbers. It accepts compact and formatted values, including the current alphanumeric CNPJ format, and provides both boolean and exception-based APIs.

## Requirements

- PHP 8.5 or later

## Installation

Install the package with Composer:

```bash
composer require cancio-labs/cnpj-validation-function
```

Composer automatically loads the package functions.

## Usage

Import the functions from the `CancioLabs\Cnpj\Functions` namespace:

```php
use function CancioLabs\Cnpj\Functions\assert_cnpj;
use function CancioLabs\Cnpj\Functions\is_valid_cnpj;
```

### `is_valid_cnpj`

Use `is_valid_cnpj(?string $cnpj): bool` when validation should return a boolean result.

```php
use function CancioLabs\Cnpj\Functions\is_valid_cnpj;

is_valid_cnpj('73.078.367/0001-00'); // true
is_valid_cnpj('73078367000100');     // true
is_valid_cnpj('12.ABC.345/01DE-35'); // true
is_valid_cnpj('12ABC34501DE35');     // true

is_valid_cnpj('73.078.367/0001-01'); // false
is_valid_cnpj(null);                 // false
```

### `assert_cnpj`

Use `assert_cnpj(?string $cnpj): void` when an invalid CNPJ should stop the current operation. It throws `InvalidArgumentException` for `null`, empty, malformed, repeated-digit, or checksum-invalid values.

```php
use function CancioLabs\Cnpj\Functions\assert_cnpj;

assert_cnpj('73.078.367/0001-00');
assert_cnpj('12ABC34501DE35');

// Throws InvalidArgumentException
assert_cnpj('73.078.367/0001-01');
```

## Accepted formats

The first 12 characters may contain uppercase or lowercase letters and digits; letters are normalized to uppercase before validation. The final two check digits must be numeric.

| Format | Example |
| --- | --- |
| Compact numeric | `73078367000100` |
| Formatted numeric | `73.078.367/0001-00` |
| Compact alphanumeric | `12ABC34501DE35` |
| Formatted alphanumeric | `12.ABC.345/01DE-35` |

## How it works

The validator checks the input format, rejects repeated numeric sequences, and verifies both CNPJ check digits. It supports the alphanumeric CNPJ format while preserving compatibility with traditional numeric CNPJs.

## Testing

Install development dependencies and run the PHPUnit suite:

```bash
composer install
vendor/bin/phpunit tests
```

## Contributing

Contributions are welcome. Please open an issue to discuss substantial changes, then submit a pull request with focused code and accompanying tests.

## License

This project is licensed under the [GNU General Public License v3.0 or later](LICENSE).
