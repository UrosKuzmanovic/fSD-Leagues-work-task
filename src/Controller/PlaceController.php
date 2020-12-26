<?php

namespace App\Controller;

use App\Entity\Place;
use App\Service\PlaceManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/place")
 */
class PlaceController extends AbstractController
{
    private $places;
    private $placeManager;

    public function __construct(PlaceManager $placeManager)
    {
        $this->placeManager = $placeManager;
    }

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

    /**
     * @Route("/add-new", name="post_place", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function addPlace(Request $request, SerializerInterface $serializer): Response
    {
        $result = $this->placeManager->addNewPlace($newPlace = $request->get("data"));

        return new JsonResponse($serializer->serialize($result, 'json'));
    }
}