<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class Currency
{
    private const USD_CODE = 'USD';
    private const VALID_CURRENCY_CODES = ['USD'];

    public function __construct(private string $isoCode = self::USD_CODE)
    {
        if (!preg_match('/^[A-Z]{3}$/', $isoCode)) {
            throw new InvalidArgumentException();
        }

        if (!in_array($this->isoCode, self::VALID_CURRENCY_CODES)) {
            throw new InvalidArgumentException();
        }
    }

    public function isoCode(): string
    {
        return $this->isoCode;
    }
}
