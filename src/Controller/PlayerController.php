<?php

namespace App\Controller;

use App\Entity\Position;
use App\Service\ClubManager;
use App\Service\PlaceManager;
use App\Service\PlayerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/player")
 */
class PlayerController extends AbstractController
{
    private $playerManager;
    private $clubManager;
    private $placeManager;

    public function __construct(
        PlayerManager $playerManager,
        ClubManager $clubManager,
        PlaceManager $placeManager
    ) {
        $this->playerManager = $playerManager;
        $this->clubManager = $clubManager;
        $this->placeManager = $placeManager;
    }

    /**
     * @Route("/list", name="player_list", methods={"GET"})
     */
    public function getPlayerList(): Response
    {
        $players = $this->playerManager->getAllPlayers();

        return $this->render(
            'player/playerList.html.twig',
            [
                'controller_name' => 'PlayerController',
                'players'         => $players,
            ]
        );
    }

    /**
     * @Route("/add", name="add_player", methods={"GET"})
     */
    public function getAddPlayer(): Response
    {
        $positions = Position::getPositions();
        $clubs = $this->clubManager->getAllClubs();
        $places = $this->placeManager->getAllPlaces();

        return $this->render(
            'player/addPlayer.html.twig',
            [
                'controller_name' => 'PlayerController',
                'positions'       => $positions,
                'clubs'           => $clubs,
                'places'          => $places,
            ]
        );
    }

    /**
     * @Route("/add-new", name="post_player", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function addPlace(
        Request $request,
        SerializerInterface $serializer
    ): Response {
        $result = $this->playerManager->addNewPlayer(
            $newPlayer = $request->get('data')
        );

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'club',
                        'place',
                    ],
                ]
            )
        );
    }

    /**
     * @Route("/edit", name="get_edit_player", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function getEditPlayer(Request $request): Response
    {
        $player = $this->playerManager->findPlayerById($request->get('id'));
        $positions = Position::getPositions();
        $clubs = $this->clubManager->getAllClubs();
        $places = $this->placeManager->getAllPlaces();

        return $this->render(
            'player/addPlayer.html.twig',
            [
                'controller_name' => 'PlaceController',
                'editPlayer'      => $player,
                'positions'       => $positions,
                'clubs'           => $clubs,
                'places'          => $places,
            ]
        );
    }

    /**
     * @Route("/edit", name="edit_player", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function editPlayer(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $result = $this->playerManager->editPlayer($request->get('data'));

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'club',
                        'place',
                    ],
                ]
            )
        );
    }

    /**
     * @Route("/delete", name="delete_player", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function deletePlayer(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $this->playerManager->deletePlayer($request->get('id'));
        $players = $this->playerManager->getAllPlayers();

        return new JsonResponse(
            $serializer->serialize(
                $players,
                'json',
                [
                    'ignored_attributes' => [
                        'club',
                        'place',
                    ],
                ]
            )
        );
    }
}
