<?php

namespace App\Controller;

use App\Service\PerformanceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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

    /**
     * @Route("/add-new", name="post_performance", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function addPerformance(
        Request $request,
        SerializerInterface $serializer
    ): Response {
        $result = $this->performanceManager->addNewPerformance(
            $newPerformance = $request->get('data')
        );

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'game',
                        'player',
                    ],
                ]
            )
        );
    }

}
