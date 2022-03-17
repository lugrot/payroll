<?php

declare(strict_types=1);

namespace App\Application\Dto;

class PayrollReportRow
{
    public function __construct(
        private string $name,
        private string $surname,
        private string $department,
        private string $baseSalary,
        private string $salaryAllowance,
        private string $salaryAllowanceType,
        private string $salary
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getBaseSalary(): string
    {
        return $this->baseSalary;
    }

    public function getSalaryAllowance(): string
    {
        return $this->salaryAllowance;
    }

    public function getSalaryAllowanceType(): string
    {
        return $this->salaryAllowanceType;
    }

    public function getSalary(): string
    {
        return $this->salary;
    }
}
