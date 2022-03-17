<?php

declare(strict_types=1);

namespace App\Tests\Domain\ValueObject;

use App\Domain\Exception\InvalidCurrencyIsoCodeException;
use App\Domain\Exception\UnsupportedCurrencyIsoCodeException;
use App\Domain\ValueObject\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function throw_invalid_currency_iso_code_exception()
    {
        $this->expectException(InvalidCurrencyIsoCodeException::class);

        new Currency('INVALID_CURRENCY_NAME');
    }

    /**
     * @test
     */
    public function throw_unsupported_currency_iso_code_exception()
    {
        $this->expectException(UnsupportedCurrencyIsoCodeException::class);

        new Currency('EUR');
    }
}
