<?php

declare(strict_types=1);

namespace App\Tests\Application\Policy;

use App\Application\Policy\PercentageSalaryAllowancePolicy;
use App\Domain\Clock\SystemClock;
use App\Domain\Entity\Department;
use App\Domain\Entity\Employee;
use App\Domain\ValueObject\SalaryAllowanceType;
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
     * @dataProvider calculationArgumentsProvider
     */
    public function percentage_calculate(int $baseSalary, int $percentagePayrollAllowance, int $expected): void
    {
        $employee = $this->buildEmployee($baseSalary, $percentagePayrollAllowance);

        $payrollAllowanceAmount = $this->percentagePolicy->calculate($employee);

        $this->assertEquals($expected, $payrollAllowanceAmount->amount());
    }

    public function calculationArgumentsProvider(): Generator
    {
        yield [110000, 10, 11000];
        yield [100000, 5, 5000];
        yield [200000, 15, 30000];
        yield [220000, 12, 26400];
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
            new SystemClock()
        );
    }
}
