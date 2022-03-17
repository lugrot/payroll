<?php

declare(strict_types=1);

namespace App\Domain\Policy;

use App\Domain\Entity\Employee;
use App\Domain\ValueObject\Money;

interface SalaryAllowancePolicyInterface
{
    public function calculate(Employee $employee): Money;
}
