<?php


namespace App\Service;


use App\Entity\Place;
use App\Repository\PlaceRepository;
use App\Utils\EntityValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PlaceManager
{
    private $placeRepository;
    private $validator;

    public function __construct(PlaceRepository $placeRepository, EntityValidator $validator)
    {
        $this->placeRepository = $placeRepository;
        $this->validator = $validator;
    }

    public function getAllPlaces(): array
    {
        return $this->placeRepository->findAll();
    }

    public function addNewPlace($newPlace)
    {
        $place = new Place();
        $place->setName($newPlace['name']);
        $place->setPtt($newPlace['ptt']);

        if($this->validator->validate($place)){
            return $this->placeRepository->addPlace($place);
        }
        return $this->validator->validate($place);
    }
}