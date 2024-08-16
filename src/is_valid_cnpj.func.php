<?php

namespace CancioLabs\Cnpj\Functions;

use InvalidArgumentException;

if (!function_exists('is_valid_cnpj')) {
    function is_valid_cnpj(string $cnpj): bool
    {
        try {
            assert_cnpj($cnpj);
            return true;
        } catch (InvalidArgumentException $e) {
            return false;
        }
    }
}