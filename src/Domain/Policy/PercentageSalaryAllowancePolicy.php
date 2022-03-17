<?php

declare(strict_types=1);

namespace App\Domain\Policy;

use App\Domain\Entity\Employee;
use Money\Money;

class PercentageSalaryAllowancePolicy implements SalaryAllowancePolicyInterface
{
    public function calculate(Employee $employee): Money
    {
        return $employee->getBaseSalary()->multiply($employee->getSalaryAllowanceAmount() / 100);
    }
}
