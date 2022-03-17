<?php

declare(strict_types=1);

namespace App\Infrastructure\DataFixtures;

use App\Domain\Clock\FixedClock;
use App\Domain\Entity\Department;
use App\Domain\Entity\Employee;
use App\Domain\ValueObject\SalaryAllowanceType;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadHrDepartmentAndEmployee($manager);
        $this->loadCsDepartmentAndEmployee($manager);
        $manager->flush();
    }

    private function loadHrDepartmentAndEmployee(ObjectManager $manager): void
    {
        $hrDepartment = new Department(Uuid::uuid4(), 'HR', 10000, SalaryAllowanceType::Fixed);
        $manager->persist($hrDepartment);

        $hrEmployee = new Employee(
            Uuid::uuid4(),
            'Adam',
            'Kowalski',
            100000,
            'USD',
            $hrDepartment,
            new FixedClock((new DateTimeImmutable())->modify('-15 years'))
        );
        $manager->persist($hrEmployee);
    }

    private function loadCsDepartmentAndEmployee(ObjectManager $manager): void
    {
        $csDepartment = new Department(Uuid::uuid4(), 'CS', 10, SalaryAllowanceType::Percentage);
        $manager->persist($csDepartment);

        $csEmployee = new Employee(
            Uuid::uuid4(),
            'Ania',
            'Nowak',
            110000,
            'USD',
            $csDepartment,
            new FixedClock((new DateTimeImmutable())->modify('-5 years'))
        );
        $manager->persist($csEmployee);
    }
}
