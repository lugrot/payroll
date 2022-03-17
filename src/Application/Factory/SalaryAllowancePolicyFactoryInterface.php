<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Policy\SalaryAllowancePolicyInterface;
use App\Domain\ValueObject\SalaryAllowanceType;

interface SalaryAllowancePolicyFactoryInterface
{
    public function create(SalaryAllowanceType $salaryAllowanceType): SalaryAllowancePolicyInterface;
}
