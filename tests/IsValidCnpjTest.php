<?php

namespace CancioLabs\Cnpj\Functions\Tests;

use function CancioLabs\Cnpj\Functions\is_valid_cnpj;
use PHPUnit\Framework\TestCase;

class IsValidCnpjTest extends TestCase
{

    use CnpjDataProvidersTrait;

    /**
     * @dataProvider invalidCnpjDataProvider
     */
    public function testConstructorWhenCnpjIsInvalid(string $invalidCNPJ): void
    {
        $this->assertFalse(is_valid_cnpj($invalidCNPJ));
    }

    /**
     * @dataProvider validCnpjDataProvider
     */
    public function testConstructorAndGetters(string $raw, string $formatted): void
    {
        $this->assertTrue(is_valid_cnpj($raw));
        $this->assertTrue(is_valid_cnpj($formatted));
    }

}