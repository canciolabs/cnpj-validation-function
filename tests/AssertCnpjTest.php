<?php

namespace CancioLabs\Cnpj\Functions\Tests;

use function CancioLabs\Cnpj\Functions\assert_cnpj;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AssertCnpjTest extends TestCase
{

    use CnpjDataProvidersTrait;

    /**
     * @dataProvider invalidCnpjDataProvider
     */
    public function testConstructorWhenCnpjIsInvalid(string $invalidCNPJ): void
    {
        $this->expectException(InvalidArgumentException::class);

        assert_cnpj($invalidCNPJ);
    }

    /**
     * @dataProvider validCnpjDataProvider
     */
    public function testConstructorAndGetters(string $raw, string $formatted): void
    {
        $this->expectNotToPerformAssertions();

        assert_cnpj($raw);
        assert_cnpj($formatted);
    }

}