# CNPJ functions

This tiny package contains some functions to validate a CNPJ (Brazilian Company ID)

## Requirements

PHP >= 8.0.0

## Installation

    composer require cancio-labs/cnpj-validation-function

## Functions

1. is_valid_cnpj
2. assert_cnpj

## How to use it

### is_valid_cnpj(string $cnpj): bool

Returns true if the CNPJ is valid, false otherwise.

```
use function CancioLabs\Cnpj\Functions\is_valid_cnpj;

// Passing formatted CNPJs
is_valid_cnpj('86.338.579/0001-12') // returns true
is_valid_cnpj('46.133.600/0001-01') // returns false

// Passing raw CNPJs
is_valid_cnpj('46133600000129') // returns true
is_valid_cnpj('46133600000101') // returns false
```

### assert_cnpj(string $cnpj): void

Validates the CNPJ and throw an InvalidArgumentException if the CNPJ is not valid.

```
use function CancioLabs\Cnpj\Functions\assert_cnpj;

// These 2 example will execute normally
assert_cnpj('27.187.233/0001-00');
assert_cnpj('27187233000100');

// These 3 examples throw InvalidArgumentException
assert_cnpj('')
assert_cnpj('foo')
assert_cnpj('27187233000111')
```

## Running Tests

- From the project root, run: `vendor/bin/phpunit .`