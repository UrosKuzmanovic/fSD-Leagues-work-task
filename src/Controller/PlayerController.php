<?php

namespace App\Controller;

use App\Service\PlayerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player")
 */
class PlayerController extends AbstractController
{
    private $playerManager;

    public function __construct(PlayerManager $playerManager)
    {
        $this->playerManager = $playerManager;
    }

    /**
     * @Route("/list", name="player_list", methods={"GET"})
     */
    public function getPlayerList(): Response
    {
        $players = $this->playerManager->getAllPlayers();
        return $this->render(
            'player/playerList.html.twig', [
            'controller_name' => 'PlayerController',
            'players' => $players
        ]);
    }

    /**
     * @Route("/add", name="add_player", methods={"GET"})
     */
    public function getAddPlayer(): Response
    {
        return $this->render(
            'player/addPlayer.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }
}
