<?php

declare(strict_types=1);

namespace App\Domain\Clock;

use DateTimeImmutable;

class SystemClock implements ClockInterface
{
    public function getDateTime(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
