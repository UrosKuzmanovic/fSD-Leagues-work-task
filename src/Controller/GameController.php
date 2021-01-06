<?php

namespace App\Controller;

use App\Service\ClubManager;
use App\Service\CompetitionManager;
use App\Service\GameManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
                        'competition',
                    ],
                ]
            )
        );
    }

    /**
     * @Route("/edit", name="get_edit_game", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     *
     * @return Response
     */
    public function getEditGame(Request $request): Response
    {
        $game = $this->gameManager->findGameById($request->get('id'));
        $clubs = $this->clubManager->getAllClubs();
        $competitions = $this->competitionManager->getAllCompetitions();

        return $this->render(
            'game/addGame.html.twig',
            [
                'controller_name' => 'GameController',
                'editGame'        => $game,
                'clubs'           => $clubs,
                'competitions'    => $competitions,
            ]
        );
    }

    /**
     * @Route("/edit", name="edit_game", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function editGame(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $result = $this->gameManager->editGame($request->get('data'));

        return new JsonResponse(
            $serializer->serialize(
                $result,
                'json',
                [
                    'ignored_attributes' => [
                        'home',
                        'away',
                        'competition',
                    ],
                ]
            )
        );
    }

    /**
     * @Route("/delete", name="delete_game", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function deleteGame(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $this->gameManager->deleteGame($request->get('id'));
        $games = $this->gameManager->getAllGames();

        return new JsonResponse(
            $serializer->serialize(
                $games,
                'json',
                [
                    'ignored_attributes' => [
                        'home',
                        'away',
                        'competition',
                    ],
                ]
            )
        );
    }

    /**
     * @Route("/get-all-games", name="get_all_games", methods={"GET"})
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function getAllGames(SerializerInterface $serializer): JsonResponse
    {
        $games = $this->gameManager->getAllGames();

        return new JsonResponse(
            $serializer->serialize(
                $games,
                'json',
                [
                    'ignored_attributes' => [
                        'home',
                        'away',
                        'competition',
                        'performances'
                    ],
                ]
            )
        );
    }
}
