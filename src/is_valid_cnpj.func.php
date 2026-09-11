<?php

declare(strict_types=1);

namespace CancioLabs\Cnpj\Functions;

use InvalidArgumentException;

if (!function_exists('is_valid_cnpj')) {
    function is_valid_cnpj(?string $cnpj): bool
    {
        try {
            assert_cnpj($cnpj);
            return true;
        } catch (InvalidArgumentException) {
            return false;
        }
    }
}