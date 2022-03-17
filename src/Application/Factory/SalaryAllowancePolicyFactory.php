<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Policy\FixedSalaryAllowancePolicy;
use App\Application\Policy\PercentageSalaryAllowancePolicy;
use App\Domain\Policy\SalaryAllowancePolicyInterface;
use App\Domain\ValueObject\SalaryAllowanceType;

class SalaryAllowancePolicyFactory implements SalaryAllowancePolicyFactoryInterface
{
    public function create(SalaryAllowanceType $salaryAllowanceType): SalaryAllowancePolicyInterface
    {
        return match ($salaryAllowanceType) {
            SalaryAllowanceType::Fixed => new FixedSalaryAllowancePolicy(),
            SalaryAllowanceType::Percentage => new PercentageSalaryAllowancePolicy(),
        };
    }
}
