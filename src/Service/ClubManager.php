<?php


namespace App\Service;


use App\Repository\ClubRepository;
use App\Utils\EntityValidator;

class ClubManager
{
    private $clubRepository;
    private $validator;

    public function __construct(ClubRepository $clubRepository, EntityValidator $validator)
    {
        $this->clubRepository = $clubRepository;
        $this->validator = $validator;
    }

    public function getAllClubs(): array
    {
        return $this->clubRepository->findAll();
    }
}