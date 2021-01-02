<?php


namespace App\Service;


use App\Entity\Game;
use App\Repository\GameRepository;
use App\Utils\EntityValidator;

class GameManager
{
    private $gameRepository;
    private $clubManager;
    private $competitionManager;
    private $validator;

    public function __construct(
        GameRepository $gameRepository,
        ClubManager $clubManager,
        CompetitionManager $competitionManager,
        EntityValidator $validator
    ) {
        $this->gameRepository = $gameRepository;
        $this->clubManager = $clubManager;
        $this->competitionManager = $competitionManager;
        $this->validator = $validator;
    }

    public function getAllGames(): array
    {
        return $this->gameRepository->findAll();
    }

    public function findGameById(int $id): ?Game
    {
        return $this->gameRepository->find($id);
    }

    public function addNewGame($newGame)
    {
        $game = new Game();
        $game->setHome($this->clubManager->findClubById($newGame['home']));
        $game->setAway($this->clubManager->findClubById($newGame['away']));
        $game->setHomeClubGoals($newGame['homeGoals']);
        $game->setAwayClubGoals($newGame['awayGoals']);
        $game->setCompetition(
            $this->competitionManager->findCompetitionById(
                $newGame['competition']
            )
        );
        try {
            $game->setGameDate(new \DateTime($newGame['date']));
        } catch (\Exception $e) {
        }

        if ($this->validator->validate($game)) {
            return $this->gameRepository->addGame($game);
        }

        return $this->validator->validate($game);
    }

    public function editGame($newGame)
    {
        $game = $this->findGameById($newGame['gameID']);
        $game->setHome($this->clubManager->findClubById($newGame['home']));
        $game->setAway($this->clubManager->findClubById($newGame['away']));
        $game->setHomeClubGoals($newGame['homeGoals']);
        $game->setAwayClubGoals($newGame['awayGoals']);
        $game->setCompetition(
            $this->competitionManager->findCompetitionById(
                $newGame['competition']
            )
        );
        try {
            $game->setGameDate(new \DateTime($newGame['date']));
        } catch (\Exception $e) {
        }

        if ($this->validator->validate($game)) {
            return $this->gameRepository->addGame($game);
        }

        return $this->validator->validate($game);
    }
}