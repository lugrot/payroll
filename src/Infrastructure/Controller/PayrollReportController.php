<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Factory\PayrollReportFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayrollReportController extends AbstractController
{
    public function __construct(private PayrollReportFactory $payrollReportFactory)
    {
    }

    #[Route('/', name: 'payrollReport')]
    public function create(): Response
    {
        $payroll = $this->payrollReportFactory->create();

        return $this->render('payroll/report.html.twig', ['payroll' => $payroll->getReport()]);
    }
}
