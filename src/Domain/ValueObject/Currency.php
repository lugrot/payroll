<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidCurrencyIsoCodeException;
use App\Domain\Exception\UnsupportedCurrencyIsoCodeException;

class Currency
{
    private const USD_CODE = 'USD';
    private const VALID_CURRENCY_CODES = ['USD'];

    /**
     * @throws InvalidCurrencyIsoCodeException
     * @throws UnsupportedCurrencyIsoCodeException
     */
    public function __construct(private string $isoCode = self::USD_CODE)
    {
        if (!preg_match('/^[A-Z]{3}$/', $isoCode)) {
            throw new InvalidCurrencyIsoCodeException();
        }

        if (!in_array($this->isoCode, self::VALID_CURRENCY_CODES)) {
            throw new UnsupportedCurrencyIsoCodeException();
        }
    }

    public function isoCode(): string
    {
        return $this->isoCode;
    }
}
