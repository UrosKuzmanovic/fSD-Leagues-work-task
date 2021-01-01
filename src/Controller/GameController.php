<?php

namespace App\Controller;

use App\Service\GameManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    private $gameManager;

    public function __construct(GameManager $gameManager)
    {
        $this->gameManager = $gameManager;
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
                'games'         => $games,
            ]
        );
    }

    /**
     * @Route("/add", name="add_game", methods={"GET"})
     */
    public function getAddGames(): Response
    {
        return $this->render(
            'game/addGame.html.twig',
            [
                'controller_name' => 'GameController',
            ]
        );
    }
}
