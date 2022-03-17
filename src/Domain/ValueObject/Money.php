<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

class Money
{
    public function __construct(
        private int|float $amount,
        private Currency $currency
    ) {
    }

    public function add(Money $money): self
    {
        return new self(
            $this->amount + $money->amount,
            $this->currency
        );
    }

    public function multiply(int|float $multiplier): self
    {
        return new self(
            $this->amount * $multiplier,
            $this->currency
        );
    }

    public function amount(): int|float
    {
        return $this->amount;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }
}
