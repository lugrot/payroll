<?php

declare(strict_types=1);

namespace App\Application\Policy;

use App\Domain\Entity\Employee;
use App\Domain\Policy\SalaryAllowancePolicyInterface;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Money;

class FixedSalaryAllowancePolicy implements SalaryAllowancePolicyInterface
{
    private const MAX_SENIORITY_YEARS_THRESHOLD = 10;

    public function calculate(Employee $employee): Money
    {
        $amount = new Money($employee->getSalaryAllowanceAmount(), new Currency($employee->getCurrency()));
        $seniorityRate = $this->getSeniorityRate($employee->getSeniorityInYears());

        return $amount->multiply($seniorityRate);
    }

    private function getSeniorityRate(int $seniority): int
    {
        if (self::MAX_SENIORITY_YEARS_THRESHOLD <= $seniority) {
            return self::MAX_SENIORITY_YEARS_THRESHOLD;
        }

        return $seniority;
    }
}
