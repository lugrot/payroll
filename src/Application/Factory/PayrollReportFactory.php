<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Dto\PayrollReportList;
use App\Domain\Repository\EmployeeRepositoryInterface;

class PayrollReportFactory implements PayrollReportFactoryInterface
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private PayrollReportRowFactoryInterface $payrollReportRowFactory
    ) {
    }

    public function create(): PayrollReportList
    {
        $employees = $this->employeeRepository->findAll();

        $payroll = new PayrollReportList();
        foreach ($employees as $employee) {
            $payrollReportRow = $this->payrollReportRowFactory->create($employee);

            $payroll->addRow($payrollReportRow);
        }

        return $payroll;
    }
}
