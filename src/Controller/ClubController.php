<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/club")
 */
class ClubController extends AbstractController
{
    private $clubs;

    /**
     * @Route("/list", name="club_list", methods={"GET"})
     */
    public function getClubList(): Response
    {
        return $this->render(
            'club/clubList.html.twig', [
            'controller_name' => 'ClubController',
            'clubs' => $this->clubs
        ]);
    }

    /**
     * @Route("/add", name="add_club", methods={"GET"})
     */
    public function getAddClub(): Response
    {
        return $this->render(
            'club/addClub.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
}
