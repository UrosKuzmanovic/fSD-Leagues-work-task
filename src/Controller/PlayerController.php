<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/player")
 */
class PlayerController extends AbstractController
{
    private $players;

    /**
     * @Route("/list", name="player_list", methods={"GET"})
     */
    public function getPlayerList(): Response
    {
        return $this->render(
            'player/playerList.html.twig', [
            'controller_name' => 'PlayerController',
            'players' => $this->players
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
