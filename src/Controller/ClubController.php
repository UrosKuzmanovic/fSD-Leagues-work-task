<?php

namespace App\Controller;

use App\Service\ClubManager;
use App\Service\PlaceManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/club")
 */
class ClubController extends AbstractController
{
    private $clubManager;
    private $placeManager;

    public function __construct(
        ClubManager $clubManager,
        PlaceManager $placeManager
    ) {
        $this->clubManager = $clubManager;
        $this->placeManager = $placeManager;
    }

    /**
     * @Route("/list", name="club_list", methods={"GET"})
     */
    public function getClubList(): Response
    {
        $clubs = $this->clubManager->getAllClubs();

        return $this->render(
            'club/clubList.html.twig',
            [
                'controller_name' => 'ClubController',
                'clubs'           => $clubs,
            ]
        );
    }

    /**
     * @Route("/add", name="add_club", methods={"GET"})
     */
    public function getAddClub(): Response
    {
        $places = $this->placeManager->getAllPlaces();

        return $this->render(
            'club/addClub.html.twig',
            [
                'controller_name' => 'ClubController',
                'places'          => $places,
            ]
        );
    }

    /**
     * @Route("/add-new", name="post_club", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function addClub(
        Request $request,
        SerializerInterface $serializer
    ): Response {
        $result = $this->clubManager->addNewClub(
            $newClub = $request->get('data')
        );

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'matchesHome',
                        'matchesAway',
                        'players',
                        'place',
                    ],
                ]
            )
        );
    }

    /**
     * @Route("/edit", name="get_edit_club", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function getEditClub(Request $request): Response
    {
        $club = $this->clubManager->findClubById($request->get('id'));
        $places = $this->placeManager->getAllPlaces();

        return $this->render(
            'club/addClub.html.twig',
            [
                'controller_name' => 'ClubController',
                'editClub'        => $club,
                'places'          => $places,
            ]
        );
    }

    /**
     * @Route("/edit", name="edit_club", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function editClub(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $result = $this->clubManager->editClub($request->get('data'));

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'matchesHome',
                        'matchesAway',
                        'players',
                        'place',
                    ],
                ]
            )
        );
    }
}
