<?php

declare(strict_types=1);

namespace App\Domain\Clock;

use DateTimeImmutable;

class FixedClock implements ClockInterface
{
    public function __construct(private DateTimeImmutable $dateTime)
    {
    }

    public function getDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }
}
