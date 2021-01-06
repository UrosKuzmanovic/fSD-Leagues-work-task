<?php

namespace App\Controller;

use App\Service\PlaceManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
    private $placeManager;

    public function __construct(PlaceManager $placeManager)
    {
        $this->placeManager = $placeManager;
    }

    /**
     * @Route("/list", name="place_list", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function getPlaceList(): Response
    {
        $places = $this->placeManager->getAllPlaces();

        return $this->render(
            'place/placeList.html.twig',
            [
                'controller_name' => 'PlaceController',
                'places'          => $places,
            ]
        );
    }

    /**
     * @Route("/add", name="add_place", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function getAddPlace(): Response
    {
        return $this->render(
            'place/addPlace.html.twig',
            [
                'controller_name' => 'PlaceController',
            ]
        );
    }

    /**
     * @Route("/add-new", name="post_place", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function addPlace(
        Request $request,
        SerializerInterface $serializer
    ): Response {
        $result = $this->placeManager->addNewPlace(
            $newPlace = $request->get('data')
        );

        return new JsonResponse($serializer->serialize($result, 'json'));
    }

    /**
     * @Route("/edit", name="get_edit_place", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     *
     * @return Response
     */
    public function getEditPlace(Request $request): Response
    {
        $place = $this->placeManager->findPlaceById($request->get('id'));

        return $this->render(
            'place/addPlace.html.twig',
            [
                'controller_name' => 'PlaceController',
                'editPlace'       => $place,
            ]
        );
    }

    /**
     * @Route("/edit", name="edit_place", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request             $request
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    public function editPlace(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $result = $this->placeManager->editPlace($request->get('data'));

        return new JsonResponse($serializer->serialize($result, 'json'));
    }

    /**
     * @Route("/delete", name="delete_place", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request             $request
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function deletePlace(
        Request $request,
        SerializerInterface $serializer
    ): JsonResponse {
        $this->placeManager->deletePlace($request->get('id'));
        $places = $this->placeManager->getAllPlaces();

        return new JsonResponse($serializer->serialize($places, 'json'));
    }
}
