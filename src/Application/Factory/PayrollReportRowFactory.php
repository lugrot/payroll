<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Dto\PayrollReportRow;
use App\Application\Formatter\MoneyFormatter;
use App\Domain\Entity\Employee;

class PayrollReportRowFactory implements PayrollReportRowFactoryInterface
{
    public function __construct(private SalaryAllowancePolicyFactoryInterface $salaryAllowancePolicyFactory)
    {
    }

    public function create(Employee $employee): PayrollReportRow
    {
        $salaryAllowancePolicy = $this->salaryAllowancePolicyFactory->create($employee->getSalaryAllowanceType());
        $salaryAllowanceAmount = $salaryAllowancePolicy->calculate($employee);
        $salary = $employee->getBaseSalary()->add($salaryAllowanceAmount);

        return new PayrollReportRow(
            $employee->getName(),
            $employee->getSurname(),
            $employee->getDepartmentName(),
            MoneyFormatter::humanFormat($employee->getBaseSalary()),
            MoneyFormatter::humanFormat($salaryAllowanceAmount),
            $employee->getSalaryAllowanceType()->name,
            MoneyFormatter::humanFormat($salary)
        );
    }
}
