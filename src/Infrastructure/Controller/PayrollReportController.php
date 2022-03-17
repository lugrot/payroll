<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\Factory\PayrollReportFactory;
use App\Domain\Repository\EmployeeRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayrollReportController extends AbstractController
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private PayrollReportFactory $payrollReportFactory
    ) {
    }

    #[Route('/', name: 'payrollReport')]
    public function create(): Response
    {
        $employees = $this->employeeRepository->findAll();

        $payroll = $this->payrollReportFactory->create($employees);

        return $this->render('payroll/report.html.twig', ['payroll' => $payroll]);
    }
}
