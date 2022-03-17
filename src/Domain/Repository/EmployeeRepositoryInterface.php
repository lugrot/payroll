<?php

declare(strict_types=1);


namespace App\Domain\Repository;

use App\Domain\Entity\Employee;

interface EmployeeRepositoryInterface
{
    /**
     * @return Employee[]
     */
    public function findAll();
}
