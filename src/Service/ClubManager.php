<?php


namespace App\Service;


use App\Entity\Club;
use App\Repository\ClubRepository;
use App\Utils\EntityValidator;

class ClubManager
{
    private $clubRepository;
    private $placeManager;
    private $validator;

    public function __construct(
        ClubRepository $clubRepository,
        PlaceManager $placeManager,
        EntityValidator $validator
    ) {
        $this->clubRepository = $clubRepository;
        $this->placeManager = $placeManager;
        $this->validator = $validator;
    }

    public function getAllClubs(): array
    {
        return $this->clubRepository->findAll();
    }

    public function addNewClub($newClub)
    {
        $club = new Club();
        $club->setName($newClub['name']);
        $club->setPlace(
            $this->placeManager->findPlaceById($newClub['placeID'])
        );
        if ($this->validator->validate($club)) {
            return $this->clubRepository->addClub($club);
        }

        return $this->validator->validate($club);
    }

    public function editClub($editedClub)
    {
        $club = $this->findClubById($editedClub['clubID']);
        $club->setName($editedClub['name']);
        $club->setPlace(
            $this->placeManager->findPlaceById($editedClub['placeID'])
        );
        if ($this->validator->validate($club)) {
            return $this->clubRepository->addClub($club);
        }

        return $this->validator->validate($club);
    }

    public function findClubById(int $id): Club
    {
        return $this->clubRepository->find($id);
    }
}