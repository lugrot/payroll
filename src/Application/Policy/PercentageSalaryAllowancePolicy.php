<?php

declare(strict_types=1);

namespace App\Application\Policy;

use App\Domain\Entity\Employee;
use App\Domain\Policy\SalaryAllowancePolicyInterface;
use App\Domain\ValueObject\Money;

class PercentageSalaryAllowancePolicy implements SalaryAllowancePolicyInterface
{
    public function calculate(Employee $employee): Money
    {
        return $employee->getBaseSalary()->multiply($employee->getSalaryAllowanceAmount() / 100);
    }
}
