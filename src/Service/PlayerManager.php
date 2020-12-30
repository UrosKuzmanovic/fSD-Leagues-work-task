<?php


namespace App\Service;


use App\Repository\PlayerRepository;

class PlayerManager
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function getAllPlayers(): array
    {
        return $this->playerRepository->findAll();
    }
}