<?php

declare(strict_types=1);


namespace App\Tests\Domain\Policy;

use App\Domain\Entity\Department;
use App\Domain\Entity\Employee;
use App\Domain\Entity\SalaryAllowanceType;
use App\Domain\Policy\PercentageSalaryAllowancePolicy;
use DateTimeImmutable;
use Generator;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PercentageSalaryAllowancePolicyTest extends TestCase
{
    private PercentageSalaryAllowancePolicy $percentagePolicy;

    protected function setUp(): void
    {
        $this->percentagePolicy = new PercentageSalaryAllowancePolicy();
    }

    /**
     * @test
     * @dataProvider arguments
     */
    public function percentage_calculate(int $baseSalary, int $percentagePayrollAllowance, int $expected): void
    {
        $employee = $this->buildEmployee($baseSalary, $percentagePayrollAllowance);

        $payrollAllowanceAmount = $this->percentagePolicy->calculate($employee);

        $this->assertEquals($expected, $payrollAllowanceAmount->getAmount());
    }

    public function arguments(): Generator
    {
        yield [1100, 10, 110];
        yield [1000, 5, 50];
        yield [2000, 15, 300];
        yield [2200, 12, 264];
    }

    private function buildEmployee(int $baseSalary, int $percentagePayrollAllowance): Employee
    {
        $department = new Department(
            Uuid::uuid4(),
            'Department',
            $percentagePayrollAllowance,
            SalaryAllowanceType::Percentage
        );

        return new Employee(
            Uuid::uuid4(),
            'John',
            'Doe',
            $baseSalary,
            'USD',
            $department,
            new DateTimeImmutable()
        );
    }
}
