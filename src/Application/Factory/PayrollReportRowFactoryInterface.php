<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Dto\PayrollReportRow;
use App\Domain\Entity\Employee;

interface PayrollReportRowFactoryInterface
{
    public function create(Employee $employee): PayrollReportRow;
}
