<?php

declare(strict_types=1);

namespace CancioLabs\Cnpj\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use function CancioLabs\Cnpj\Functions\assert_cnpj;
use InvalidArgumentException;

class AssertCnpjTest extends CnpjTestCase
{

    #[DataProvider('invalidCnpjDataProvider')]
    public function testConstructorWhenCnpjIsInvalid(?string $invalidCNPJ): void
    {
        $this->expectException(InvalidArgumentException::class);

        assert_cnpj($invalidCNPJ);
    }

    #[DataProvider('validCnpjDataProvider')]
    public function testConstructorAndGetters(string $raw, string $formatted): void
    {
        $this->expectNotToPerformAssertions();

        assert_cnpj($raw);
        assert_cnpj($formatted);
    }

}