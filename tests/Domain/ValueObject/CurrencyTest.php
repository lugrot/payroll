<?php

declare(strict_types=1);

namespace App\Tests\Domain\ValueObject;

use App\Domain\ValueObject\Currency;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function throw_invalid_argument_exception_on_incorrect_iso_code()
    {
        $this->expectException(InvalidArgumentException::class);

        new Currency('INVALID_CURRENCY_NAME');
    }

    /**
     * @test
     */
    public function throw_invalid_argument_exception_on_unsupported_currency()
    {
        $this->expectException(InvalidArgumentException::class);

        new Currency('EUR');
    }
}
