<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/match")
 */
class MatchController extends AbstractController
{
    private $matches;

    /**
     * @Route("/list", name="match_list", methods={"GET"})
     */
    public function getMatchList(): Response
    {
        return $this->render(
            'match/matchList.html.twig', [
            'controller_name' => 'MatchController',
            'matches' => $this->matches
        ]);
    }

    /**
     * @Route("/add", name="add_match", methods={"GET"})
     */
    public function getAddMatch(): Response
    {
        return $this->render(
            'match/addMatch.html.twig', [
            'controller_name' => 'MatchController',
        ]);
    }
}
