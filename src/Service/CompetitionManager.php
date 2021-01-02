<?php


namespace App\Service;


use App\Entity\Competition;
use App\Repository\CompetitionRepository;

class CompetitionManager
{
    private $competitionRepository;

    public function __construct(CompetitionRepository $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

    public function getAllCompetitions(): array
    {
        return $this->competitionRepository->findAll();
    }

    public function findCompetitionById(int $id): ?Competition
    {
        return $this->competitionRepository->find($id);
    }
}