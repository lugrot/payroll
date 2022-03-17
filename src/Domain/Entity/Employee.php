<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Clock\ClockInterface;
use App\Domain\Clock\SystemClock;
use App\Domain\ValueObject\Currency;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\SalaryAllowanceType;
use App\Infrastructure\Repository\EmployeeRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Ramsey\Uuid\UuidInterface;

#[Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[Id]
    #[Column(type: "uuid", unique: true)]
    private UuidInterface $id;

    #[Column(type: "string", length: 255)]
    private string $name;

    #[Column(type: "string", length: 255)]
    private string $surname;

    #[Column(type: "integer")]
    private int $baseSalary;

    #[Column(type: "string", length: 3)]
    private string $currency;

    #[ManyToOne(targetEntity: Department::class)]
    private Department $department;

    #[Column(type: "datetime_immutable")]
    private DateTimeImmutable $dateOfHire;

    public function __construct(
        UuidInterface $id,
        string $name,
        string $surname,
        int $baseSalary,
        string $currency,
        Department $department,
        ClockInterface $dateOfHire
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->baseSalary = $baseSalary;
        $this->currency = $currency;
        $this->department = $department;
        $this->dateOfHire = $dateOfHire->getDateTime();
    }

    public function getSeniorityInYears(): int
    {
        return (new SystemClock())->getDateTime()->diff($this->dateOfHire)->y;
    }

    public function getBaseSalary(): Money
    {
        return new Money($this->baseSalary, new Currency($this->getCurrency()));
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSalaryAllowanceAmount(): int
    {
        return $this->department->getSalaryAllowanceAmount();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getDepartmentName(): string
    {
        return $this->department->getName();
    }

    public function getSalaryAllowanceType(): SalaryAllowanceType
    {
        return $this->department->getSalaryAllowanceType();
    }
}
