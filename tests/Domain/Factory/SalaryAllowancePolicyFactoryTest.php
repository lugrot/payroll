<?php

declare(strict_types=1);


namespace App\Tests\Domain\Factory;

use App\Domain\Entity\SalaryAllowanceType;
use App\Domain\Factory\SalaryAllowancePolicyFactory;
use App\Domain\Policy\FixedSalaryAllowancePolicy;
use App\Domain\Policy\PercentageSalaryAllowancePolicy;
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
        yield 'creating percentage salary allowance policy for percentage type' => [
            SalaryAllowanceType::Percentage,
            PercentageSalaryAllowancePolicy::class
        ];
        yield 'creating fixed salary allowance policy for fixed type' => [
            SalaryAllowanceType::Fixed,
            FixedSalaryAllowancePolicy::class
        ];
    }
}
