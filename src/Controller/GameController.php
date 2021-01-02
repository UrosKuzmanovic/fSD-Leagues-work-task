<?php

namespace App\Controller;

use App\Service\ClubManager;
use App\Service\CompetitionManager;
use App\Service\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    private $gameManager;
    private $clubManager;
    private $competitionManager;

    public function __construct(
        GameManager $gameManager,
        ClubManager $clubManager,
        CompetitionManager $competitionManager
    ) {
        $this->gameManager = $gameManager;
        $this->clubManager = $clubManager;
        $this->competitionManager = $competitionManager;
    }

    /**
     * @Route("/list", name="game_list", methods={"GET"})
     */
    public function getGameList(): Response
    {
        $games = $this->gameManager->getAllGames();

        return $this->render(
            'game/gameList.html.twig',
            [
                'controller_name' => 'GameController',
                'games'           => $games,
            ]
        );
    }

    /**
     * @Route("/add", name="add_game", methods={"GET"})
     */
    public function getAddGames(): Response
    {
        $clubs = $this->clubManager->getAllClubs();
        $competitions = $this->competitionManager->getAllCompetitions();

        return $this->render(
            'game/addGame.html.twig',
            [
                'controller_name' => 'GameController',
                'clubs'           => $clubs,
                'competitions'    => $competitions,
            ]
        );
    }

    /**
     * @Route("/add-new", name="post_game", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function addGame(
        Request $request,
        SerializerInterface $serializer
    ): Response {
        $result = $this->gameManager->addNewGame(
            $newGame = $request->get('data')
        );

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'home',
                        'away',
                        'competition'
                    ],
                ]
            )
        );
    }
}
