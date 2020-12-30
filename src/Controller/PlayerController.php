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

        return new JsonResponse($serializer->serialize($result, 'json', [
            'ignored_attributes' => [
                'club',
                'place',
            ],
        ]));
    }
}
