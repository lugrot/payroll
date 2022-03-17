<?php

declare(strict_types=1);


namespace App\Tests\Application\Factory;

use App\Application\Factory\SalaryAllowancePolicyFactory;
use App\Application\Policy\FixedSalaryAllowancePolicy;
use App\Application\Policy\PercentageSalaryAllowancePolicy;
use App\Domain\ValueObject\SalaryAllowanceType;
use Generator;
use PHPUnit\Framework\TestCase;

class SalaryAllowancePolicyFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider validPolicyProvider
     */
    public function creating_valid_salary_allowance_policy_for_given_type(
        SalaryAllowanceType $salaryAllowanceType,
        string $expected
    ): void {
        $factory = new SalaryAllowancePolicyFactory();

        $policy = $factory->create($salaryAllowanceType);

        $this->assertInstanceOf($expected, $policy);
    }

    public function validPolicyProvider(): Generator
    {
        yield 'percentage salary allowance policy for percentage type' => [
            SalaryAllowanceType::Percentage,
            PercentageSalaryAllowancePolicy::class
        ];
        yield 'fixed salary allowance policy for fixed type' => [
            SalaryAllowanceType::Fixed,
            FixedSalaryAllowancePolicy::class
        ];
    }
}
