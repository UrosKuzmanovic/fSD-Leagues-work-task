<?php

namespace App\Controller;

use App\Service\PerformanceManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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

    public function __construct(
        PerformanceManager $performanceManager
    ) {
        $this->performanceManager = $performanceManager;
    }

    /**
     * @Route("/list", name="performance_list", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function getPerformanceList(): Response
    {
        if ($this->isGranted("ROLE_ADMIN")) {
            $performances = $this->performanceManager->getAllPerformances();
        } else {
            $userEmail = $this->getUser()->getUsername();
            $performances = $this->performanceManager->getAllPerformancesForPlayer($userEmail);
        }

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
     * @IsGranted("ROLE_ADMIN")
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

    /**
     * @Route("/edit", name="get_edit_performance", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     *
     * @return Response
     */
    public function getEditPerformance(Request $request): Response
    {
        $performance = $this->performanceManager->findPerformanceById(
            $request->get('id')
        );

        return $this->render(
            'performance/addPerformance.html.twig',
            [
                'controller_name' => 'PlaceController',
                'editPerformance' => $performance,
            ]
        );
    }

    /**
     * @Route("/edit", name="edit_performance", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function editPerformance(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $result = $this->performanceManager->editPerformance(
            $request->get('data')
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

    /**
     * @Route("/delete", name="delete_performance", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function deletePerformance(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $this->performanceManager->deletePerformance($request->get('id'));
        $performances = $this->performanceManager->getAllPerformances();

        return new JsonResponse(
            $serializer->serialize(
                $performances,
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
