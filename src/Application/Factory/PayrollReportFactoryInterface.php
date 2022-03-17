<?php

declare(strict_types=1);


namespace App\Application\Factory;

use App\Application\Dto\PayrollReportList;

interface PayrollReportFactoryInterface
{
    public function create(): PayrollReportList;
}
