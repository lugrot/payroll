<?php

declare(strict_types=1);

namespace App\Application\Dto;

use ArrayObject;

class PayrollReportList
{
    public function __construct(private ArrayObject $payrollReportList = new ArrayObject())
    {
    }

    public function addRow(PayrollReportRow $payrollReportRow): void
    {
        $this->payrollReportList[] = $payrollReportRow;
    }

    public function getReport(): ArrayObject
    {
        return $this->payrollReportList;
    }
}
