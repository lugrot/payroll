<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Infrastructure\Repository\DepartmentRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\UuidInterface;

#[Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: "uuid", unique: true)]
    private UuidInterface $id;

    #[Column(type: "string", length: 255)]
    private string $name;

    #[Column(type: "integer")]
    private int $salaryAllowanceAmount;

    #[Column(type: "string", enumType: SalaryAllowanceType::class)]
    private SalaryAllowanceType $salaryAllowanceType;

    public function __construct(
        UuidInterface $id,
        string $name,
        int $salaryAllowanceAmount,
        SalaryAllowanceType $salaryAllowanceType
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->salaryAllowanceAmount = $salaryAllowanceAmount;
        $this->salaryAllowanceType = $salaryAllowanceType;
    }

    public function getSalaryAllowanceAmount(): int
    {
        return $this->salaryAllowanceAmount;
    }

    public function getSalaryAllowanceType(): SalaryAllowanceType
    {
        return $this->salaryAllowanceType;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
