<?php


namespace App\Service;


use App\Repository\PerformanceRepository;

class PerformanceManager
{
    private $performanceRepository;

    public function __construct(PerformanceRepository $performanceRepository)
    {
        $this->performanceRepository = $performanceRepository;
    }

    public function getAllPerformances(): array
    {
        return $this->performanceRepository->findAll();
    }
}