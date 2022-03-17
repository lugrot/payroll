<?php

declare(strict_types=1);


namespace App\Tests\Domain\Policy;

use App\Domain\Entity\Department;
use App\Domain\Entity\Employee;
use App\Domain\Entity\SalaryAllowanceType;
use App\Domain\Policy\FixedSalaryAllowancePolicy;
use DateTimeImmutable;
use Generator;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class FixedSalaryAllowancePolicyTest extends TestCase
{
    private FixedSalaryAllowancePolicy $policy;

    protected function setUp(): void
    {
        $this->policy = new FixedSalaryAllowancePolicy();
    }

    /**
     * @test
     * @dataProvider calculationArgumentsProvider
     */
    public function calculating_payroll_allowance_for_employee(int $salary, int $seniorityInMonths, int $expected): void
    {
        $employee = $this->buildEmployee($salary, $seniorityInMonths);

        $amount = $this->policy->calculate($employee);

        $this->assertEquals($expected, $amount->getAmount());
    }

    private function calculationArgumentsProvider(): Generator
    {
        yield 'employee has not worked for a year' => [1000, 10, 0];
        yield 'employee has worked for a year' => [1000, 12, 100];
        yield 'employee has worked between one and 10 years' => [1000, 60, 500];
        yield 'employee has worked for 10 years' => [1000, 120, 1000];
        yield 'employee has worked for more than 10 years' => [1000, 180, 1000];
    }

    private function buildEmployee(int $salary, int $seniorityInMonths): Employee
    {
        $department = new Department(Uuid::uuid4(), 'test', 100, SalaryAllowanceType::Fixed);

        return new Employee(
            Uuid::uuid4(),
            'John',
            'Doe',
            $salary,
            'USD',
            $department,
            (new DateTimeImmutable())->modify(sprintf('-%d months', $seniorityInMonths))
        );
    }
}
