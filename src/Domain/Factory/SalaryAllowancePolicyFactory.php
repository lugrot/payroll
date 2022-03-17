<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\SalaryAllowanceType;
use App\Domain\Policy\FixedSalaryAllowancePolicy;
use App\Domain\Policy\PercentageSalaryAllowancePolicy;
use App\Domain\Policy\SalaryAllowancePolicyInterface;

class SalaryAllowancePolicyFactory
{
    public function create(SalaryAllowanceType $salaryAllowanceType): SalaryAllowancePolicyInterface
    {
        return match ($salaryAllowanceType) {
            SalaryAllowanceType::Fixed => new FixedSalaryAllowancePolicy(),
            SalaryAllowanceType::Percentage => new PercentageSalaryAllowancePolicy(),
        };
    }
}
