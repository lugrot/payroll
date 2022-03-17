<?php

declare(strict_types=1);

namespace App\Domain\Entity;

enum SalaryAllowanceType: string
{
    case Fixed = 'fixed';
    case Percentage = 'percentage';
}
