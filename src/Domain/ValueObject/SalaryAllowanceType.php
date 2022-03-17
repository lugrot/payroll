<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

enum SalaryAllowanceType: string
{
case Fixed = 'fixed';
case Percentage = 'percentage';
    }
