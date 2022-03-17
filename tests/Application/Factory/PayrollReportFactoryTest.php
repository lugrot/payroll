<?php

declare(strict_types=1);

namespace App\Tests\Application\Factory;

use App\Application\Dto\PayrollReportList;
use App\Application\Dto\PayrollReportRow;
use App\Application\Factory\PayrollReportFactory;
use App\Application\Factory\PayrollReportRowFactory;
use App\Application\Factory\SalaryAllowancePolicyFactory;
use App\Domain\Clock\FixedClock;
use App\Domain\Entity\Department;
use App\Domain\Entity\Employee;
use App\Domain\Repository\EmployeeRepositoryInterface;
use App\Domain\ValueObject\SalaryAllowanceType;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PayrollReportFactoryTest extends TestCase
{
    public function test()
    {
        $employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
        $employeeRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($this->employees());
        $factory = new PayrollReportFactory(
            $employeeRepository,
            new PayrollReportRowFactory(new SalaryAllowancePolicyFactory())
        );

        $payrollReport = $factory->create();

        $this->assertEquals($this->expectedPayrollReport(), $payrollReport);
    }

    private function employees(): array
    {
        $hrDepartment = new Department(Uuid::uuid4(), 'HR', 10000, SalaryAllowanceType::Fixed);
        $csDepartment = new Department(Uuid::uuid4(), 'CS', 10, SalaryAllowanceType::Percentage);

        return [
            new Employee(
                Uuid::uuid4(),
                'Adam',
                'Kowalski',
                100000,
                'USD',
                $hrDepartment,
                new FixedClock((new DateTimeImmutable())->modify('-15 years'))
            ),
            new Employee(
                Uuid::uuid4(),
                'Ania',
                'Nowak',
                110000,
                'USD',
                $csDepartment,
                new FixedClock((new DateTimeImmutable())->modify('-5 years'))
            ),
        ];
    }

    private function expectedPayrollReport(): PayrollReportList
    {
        $payrollReportList = new PayrollReportList();

        $payrollReportRow = new PayrollReportRow(
            'Adam',
            'Kowalski',
            'HR',
            "1000.00",
            "1000.00",
            "Fixed",
            "2000.00"
        );
        $payrollReportList->addRow($payrollReportRow);

        $payrollReportRow = new PayrollReportRow(
            'Ania',
            'Nowak',
            'CS',
            "1100.00",
            "110.00",
            "Percentage",
            "1210.00"
        );
        $payrollReportList->addRow($payrollReportRow);

        return $payrollReportList;
    }
}
