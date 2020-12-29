<?php

namespace App\Controller;

use App\Service\ClubManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/club")
 */
class ClubController extends AbstractController
{
    private $clubManager;

    public function __construct(ClubManager $clubManager)
    {
        $this->clubManager = $clubManager;
    }

    /**
     * @Route("/list", name="club_list", methods={"GET"})
     */
    public function getClubList(): Response
    {
        $clubs = $this->clubManager->getAllClubs();
        return $this->render(
            'club/clubList.html.twig', [
            'controller_name' => 'ClubController',
            'clubs' => $clubs
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
