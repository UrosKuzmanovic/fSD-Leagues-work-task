<?php


namespace App\Service;


use App\Entity\Player;
use App\Repository\PlayerRepository;
use App\Utils\EntityValidator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PlayerManager
{
    private $validator;
    private $playerRepository;
    private $clubManager;
    private $placeManager;
    private $imageManager;
    private $gameManager;
    private $passwordEncoder;

    public function __construct(
        EntityValidator $validator,
        PlayerRepository $playerRepository,
        ClubManager $clubManager,
        PlaceManager $placeManager,
        ImageManager $imageManager,
        GameManager $gameManager,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->validator = $validator;
        $this->playerRepository = $playerRepository;
        $this->clubManager = $clubManager;
        $this->placeManager = $placeManager;
        $this->imageManager = $imageManager;
        $this->gameManager = $gameManager;
        $this->passwordEncoder = $passwordEncoder;
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
        $player->setBase64($newPlayer['base64']);
        $player->setEmail($newPlayer['email']);
        $player->setPassword(
            $this->passwordEncoder->encodePassword(
                $player,
                $newPlayer['password']
            )
        );

        if ($this->validator->validate($player)) {
            $player->setPhotoName(
                $this->imageManager->saveImage($player)
            );

            return $this->playerRepository->addPlayer($player);
        }

        return $this->validator->validate($player);
    }

    public function editPlayer($editedPlayer)
    {
        $player = $this->findPlayerById($editedPlayer['playerID']);
        $player->setFirstName($editedPlayer['firstName']);
        $player->setLastName($editedPlayer['lastName']);
        $player->setJmbg($editedPlayer['jmbg']);
        try {
            $player->setDateOfBirth(
                new \DateTime($editedPlayer['dateOfBirth'])
            );
        } catch (\Exception $e) {
        } // new date
        $player->setPositions($editedPlayer['position']);
        $player->setClub(
            $this->clubManager->findClubById($editedPlayer['clubID'])
        );
        $player->setPlace(
            $this->placeManager->findPlaceById($editedPlayer['placeID'])
        );
        if (str_contains($editedPlayer['base64'], 'data:image')) {
            $player->setBase64($editedPlayer['base64']);
        } else {
            $player->setBase64(
                $this->imageManager->getBase64(
                    $player->getPhotoName()
                )
            );
        }
        $player->setEmail($editedPlayer['email']);

        if ($this->validator->validate($player)) {
            $this->imageManager->saveImage($player);

            return $this->playerRepository->addPlayer($player);
        }

        return $this->validator->validate($player);
    }

    public function findPlayerById(int $id): Player
    {
        return $this->playerRepository->find($id);
    }

    public function deletePlayer(int $id)
    {
        $this->playerRepository->removePlayer($id);
    }

    public function findPlayersByGame($game)
    {
        return $this->playerRepository->findPlayersByGame(
            $game['homeID'],
            $game['awayID']
        );
    }
}