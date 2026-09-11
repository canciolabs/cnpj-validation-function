<?php

declare(strict_types=1);

namespace CancioLabs\Cnpj\Functions\Tests;

use PHPUnit\Framework\TestCase;

abstract class CnpjTestCase extends TestCase
{

    public static function invalidCnpjDataProvider(): array
    {
        $testCases = [];

        // notEmpty
        $testCases[] = [null];
        $testCases[] = [''];

        // regex
        $testCases[] = [' '];
        $testCases[] = ['abcdefghijklmn'];
        $testCases[] = ['01.817.129.0001.50'];
        $testCases[] = ['01.817.129/0001.50'];
        $testCases[] = ['01-817-129/0001-50'];
        $testCases[] = ['foo01817129000150'];
        $testCases[] = ['01-817-129/0001-50foo'];
        $testCases[] = ['A1.B2C.3D4/1A2B-99'];
        $testCases[] = ['12.ABC.345/01DE-00'];
        $testCases[] = ['12.ABC.345/01DE -35'];
        $testCases[] = ['12.ABC.345/01DE_35'];

        // 00.000.000/0000-00 is invalid
        $testCases[] = ['00000000000000'];

        // invalid digits
        // "73.078.367/0001-00" and "4P.561.QV9/0001-00" are valid.
        for ($i = 1; $i <= 99; $i++) {
            $testCases[] = ['73.078.367/0001-' . str_pad((string) $i, 2, '0', STR_PAD_LEFT)];
            $testCases[] = ['4P.561.QV9/0001-' . str_pad((string) $i, 2, '0', STR_PAD_LEFT)];
        }
        $testCases[] = ['A1B2C3D41A2B99'];

        return $testCases;
    }

    public static function validCnpjDataProvider(): array
    {
        $testCases = [];

        $testCases[] = [
            'raw' => '73078367000100',
            'formatted' => '73.078.367/0001-00',
        ];

        $testCases[] = [
            'raw' => '92418358000157',
            'formatted' => '92.418.358/0001-57',
        ];

        $testCases[] = [
            'raw' => '83983685000160',
            'formatted' => '83.983.685/0001-60',
        ];

        $testCases[] = [
            'raw' => '92369079000140',
            'formatted' => '92.369.079/0001-40',
        ];

        $testCases[] = [
            'raw' => '83783151000190',
            'formatted' => '83.783.151/0001-90',
        ];

        $testCases[] = [
            'raw' => '11602778000197',
            'formatted' => '11.602.778/0001-97',
        ];

        $testCases[] = [
            'raw' => '98440654000130',
            'formatted' => '98.440.654/0001-30',
        ];

        $testCases[] = [
            'raw' => '00000000E08G12',
            'formatted' => '00.000.000/E08G-12',
        ];

        $testCases[] = [
            'raw' => '12ABC34501DE35',
            'formatted' => '12.ABC.345/01DE-35',
        ];

        $testCases[] = [
            'raw' => '12ABC34501de35',
            'formatted' => '12.ABC.345/01de-35',
        ];

        return $testCases;
    }

}