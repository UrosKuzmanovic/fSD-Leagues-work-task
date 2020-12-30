<?php


namespace App\Service;


use App\Entity\Player;
use App\Repository\PlayerRepository;
use App\Utils\EntityValidator;

class PlayerManager
{
    private $validator;
    private $playerRepository;
    private $clubManager;
    private $placeManager;

    public function __construct(
        EntityValidator $validator,
        PlayerRepository $playerRepository,
        ClubManager $clubManager,
        PlaceManager $placeManager
    ) {
        $this->validator = $validator;
        $this->playerRepository = $playerRepository;
        $this->clubManager = $clubManager;
        $this->placeManager = $placeManager;
    }

    public function getAllPlayers(): array
    {
        return $this->playerRepository->findAll();
    }

    public function addNewPlayer($newPlayer)
    {
        $player = new Player();
        $player->setFirstName($newPlayer['firstName']);
        $player->setLastName($newPlayer['lastName']);
        $player->setJmbg($newPlayer['jmbg']);
        //$player->setDateOfBirth($newPlayer['dateOfBirth']); // new date
        try {
            $player->setDateOfBirth(new \DateTime($newPlayer['dateOfBirth']));
        } catch (\Exception $e) {
        } // new date
        $player->setPositions($newPlayer['position']);
        $player->setClub(
            $this->clubManager->findClubById($newPlayer['clubID'])
        );
        $player->setPlace(
            $this->placeManager->findPlaceById($newPlayer['placeID'])
        );

        if ($this->validator->validate($player)) {
            return $this->playerRepository->addPlayer($player);
        }

        return $this->validator->validate($player);
    }
}