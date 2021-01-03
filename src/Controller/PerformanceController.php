<?php

namespace App\Controller;

use App\Service\PerformanceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performance")
 */
class PerformanceController extends AbstractController
{
    private $performanceManager;

    public function __construct(PerformanceManager $performanceManager)
    {
        $this->performanceManager = $performanceManager;
    }

    /**
     * @Route("/list", name="performance_list", methods={"GET"})
     */
    public function getPerformanceList(): Response
    {
        $performances = $this->performanceManager->getAllPerformances();

        return $this->render(
            'performance/performanceList.html.twig',
            [
                'controller_name' => 'PerformanceController',
                'performances'    => $performances,
            ]
        );
    }

    /**
     * @Route("/add", name="add_performance", methods={"GET"})
     */
    public function getAddPlace(): Response
    {
        return $this->render(
            'performance/addPerformance.html.twig',
            [
                'controller_name' => 'PerformanceController',
            ]
        );
    }
}
