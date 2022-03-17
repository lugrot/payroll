<?php

declare(strict_types=1);

namespace App\Application\Formatter;

use App\Domain\ValueObject\Money;

class MoneyFormatter
{
    public static function humanFormat(Money $money): string
    {
        return number_format($money->amount() / 100, 2, '.', '');
    }
}
