<?php


namespace App\Service;


use App\Repository\GameRepository;

class GameManager
{
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function getAllGames(): array
    {
        return $this->gameRepository->findAll();
    }
}