<?php

declare(strict_types=1);

namespace App\Tests\Application\Policy;

use App\Application\Policy\FixedSalaryAllowancePolicy;
use App\Domain\Clock\FixedClock;
use App\Domain\Entity\Department;
use App\Domain\Entity\Employee;
use App\Domain\ValueObject\SalaryAllowanceType;
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

        $this->assertEquals($expected, $amount->amount());
    }

    private function calculationArgumentsProvider(): Generator
    {
        yield 'employee has not worked for a year' => [100000, 10, 0];
        yield 'employee has worked for a year' => [100000, 12, 10000];
        yield 'employee has worked between one and 10 years' => [100000, 60, 50000];
        yield 'employee has worked for 10 years' => [100000, 120, 100000];
        yield 'employee has worked for more than 10 years' => [100000, 180, 100000];
    }

    private function buildEmployee(int $salary, int $seniorityInMonths): Employee
    {
        $department = new Department(Uuid::uuid4(), 'test', 10000, SalaryAllowanceType::Fixed);

        return new Employee(
            Uuid::uuid4(),
            'John',
            'Doe',
            $salary,
            'USD',
            $department,
            (new FixedClock((new DateTimeImmutable())->modify(sprintf('-%d months', $seniorityInMonths))))
        );
    }
}
