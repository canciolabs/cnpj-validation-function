<?php

declare(strict_types=1);

namespace CancioLabs\Cnpj\Functions;

use InvalidArgumentException;

if (!function_exists('assert_cnpj')) {
    function assert_cnpj(?string $cnpj): void
    {
        if ($cnpj === null) {
            throw new InvalidArgumentException('The CNPJ must not be null.');
        }

        if ($cnpj === '') {
            throw new InvalidArgumentException('The CNPJ must not be an empty string.');
        }

        // Convert all characters to uppercase
        // This is important because the digit calculation is case-sensitive
        $cnpj = strtoupper($cnpj);

        if (!preg_match('/^(?:[A-Z0-9]{12}\d{2}|[A-Z0-9]{2}\.[A-Z0-9]{3}\.[A-Z0-9]{3}\/[A-Z0-9]{4}-\d{2})\z/', $cnpj)) {
            throw new InvalidArgumentException('The CNPJ must match either "XX.XXX.XXX/XXXX-99" or "XXXXXXXXXXXX99" pattern.');
        }

        // Remove invalid chars
        $cnpj = preg_replace('/[^A-Z0-9]+/', '', $cnpj);

        // Check if the CNPJ is a sequence of repeated digits
        if (preg_match('/^(\d)\1{13}$/', $cnpj) === 1) {
            throw new InvalidArgumentException('The CNPJ is invalid.');
        }

        // Calculate digits
        $sumDv1 = 0;
        $sumDv2 = 0;
        $asciiZero = 48;
        $digitsWeights = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 12; ++$i) {
            $asciiDigit = ord($cnpj[$i]) - $asciiZero;
            $sumDv1 += $asciiDigit * $digitsWeights[$i + 1];
            $sumDv2 += $asciiDigit * $digitsWeights[$i];
        }

        $dv1 = $sumDv1 % 11 < 2 ? 0 : 11 - ($sumDv1 % 11);
        $sumDv2 += $dv1 * $digitsWeights[12];
        $dv2 = $sumDv2 % 11 < 2 ? 0 : 11 - ($sumDv2 % 11);

        if ($dv1 !== (int) $cnpj[12] || $dv2 !== (int) $cnpj[13]) {
            throw new InvalidArgumentException('The CNPJ is invalid.');
        }
    }
}