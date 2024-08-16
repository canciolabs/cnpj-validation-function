<?php

namespace CancioLabs\Cnpj\Functions;

use InvalidArgumentException;

if (!function_exists('assert_cnpj')) {
    function assert_cnpj(string $cnpj): void
    {
        if (empty($cnpj)) {
            throw new InvalidArgumentException('The CNPJ must not be an empty string.');
        }

        if (!preg_match('/^(\d{14})|(\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2})$/', $cnpj)) {
            throw new InvalidArgumentException('The CNPJ must match either "99.999.999/9999-99" or "99999999999999" pattern.');
        }

        // Remove non-numeric chars
        $cnpj = (string) preg_replace("/\D/", "", $cnpj);

        // 00.000.000/0000-00 is invalid
        if ($cnpj === '00000000000000') {
            throw new InvalidArgumentException('The CNPJ is invalid.');
        }

        // Calculate digits
        $c1 = $c2 = 0;
        for ($p = 0, $m = 5; $p < 12; $p++, $m--) {
            $c1 += $cnpj[$p] * $m;
            if ($p === 3) {
                $m = 10;
            }
        }
        for ($p = 0, $m = 6; $p < 13; $p++, $m--) {
            $c2 += $cnpj[$p] * $m;
            if ($p === 4) {
                $m = 10;
            }
        }

        // check if the last two digits are equal to c1 and c2
        $d1 = ($c1 % 11 < 2) ? 0 : 11 - ($c1 % 11);
        $d2 = ($c2 % 11 < 2) ? 0 : 11 - ($c2 % 11);
        if ($d1 !== (int) $cnpj[12] || $d2 !== (int) $cnpj[13]) {
            throw new InvalidArgumentException('The CNPJ is invalid.');
        }
    }
}