<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/place")
 */
class PlaceController extends AbstractController
{
    private $places;

    /**
     * @Route("/list", name="place_list", methods={"GET"})
     */
    public function getPlaceList(): Response
    {
        return $this->render(
            'place/placeList.html.twig', [
            'controller_name' => 'PlaceController',
            'places' => $this->places
        ]);
    }

    /**
     * @Route("/add", name="add_place", methods={"GET"})
     */
    public function getAddPlace(): Response
    {
        return $this->render(
            'place/addPlace.html.twig', [
            'controller_name' => 'PlaceController',
        ]);
    }
}
