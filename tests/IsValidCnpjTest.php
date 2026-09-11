<?php

declare(strict_types=1);

namespace CancioLabs\Cnpj\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use function CancioLabs\Cnpj\Functions\is_valid_cnpj;

class IsValidCnpjTest extends CnpjTestCase
{

    #[DataProvider('invalidCnpjDataProvider')]
    public function testConstructorWhenCnpjIsInvalid(?string $invalidCNPJ): void
    {
        $this->assertFalse(is_valid_cnpj($invalidCNPJ));
    }

    #[DataProvider('validCnpjDataProvider')]
    public function testConstructorAndGetters(string $raw, string $formatted): void
    {
        $this->assertTrue(is_valid_cnpj($raw));
        $this->assertTrue(is_valid_cnpj($formatted));
    }

}