<?php

namespace CancioLabs\Cnpj\Functions\Tests;

trait CnpjDataProvidersTrait
{

    public static function invalidCnpjDataProvider(): array
    {
        $testCases = [];

        // stringNotEmpty
        $testCases[] = [''];

        // regex
        $testCases[] = [' '];
        $testCases[] = ['abcdefghijklmn'];
        $testCases[] = ['01.817.129.0001.50'];
        $testCases[] = ['01.817.129/0001.50'];
        $testCases[] = ['01-817-129/0001-50'];

        // 00.000.000/0000-00 is invalid
        $testCases[] = ['00000000000000'];

        // invalid digits
        // "73.078.367/0001-00" is a valid.
        for ($i = 1; $i <= 99; $i++) {
            $testCases[] = ['73.078.367/0001-' . str_pad($i, 2, '0', STR_PAD_LEFT)];
        }

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

        return $testCases;
    }

}