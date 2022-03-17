<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Employee;
use App\Domain\Model\PayrollReportRow;

class PayrollReportFactory
{
    public function __construct(private SalaryAllowancePolicyFactory $salaryAllowancePolicyFactory,)
    {
    }

    /**
     * @param Employee[] $employees
     * @return PayrollReportRow[]
     */
    public function create(array $employees): array
    {
        $payroll = [];
        foreach ($employees as $employee) {
            $payroll[] = $this->createPayrollRecordRow($employee);
        }

        return $payroll;
    }

    private function createPayrollRecordRow(Employee $employee): PayrollReportRow
    {
        $salaryAllowancePolicy = $this->salaryAllowancePolicyFactory->create($employee->getSalaryAllowanceType());
        $salaryAllowanceAmount = $salaryAllowancePolicy->calculate($employee);
        $salary = $employee->getBaseSalary()->add($salaryAllowanceAmount);

        return new PayrollReportRow(
            $employee->getName(),
            $employee->getSurname(),
            $employee->getDepartmentName(),
            $employee->getBaseSalary()->getAmount(),
            $salaryAllowanceAmount->getAmount(),
            $employee->getSalaryAllowanceType()->name,
            $salary->getAmount()
        );
    }
}
