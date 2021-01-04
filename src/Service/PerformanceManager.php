<?php


namespace App\Service;


use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PerformanceManager
{
    private $performanceRepository;
    private $playerManager;
    private $gameManager;
    private $validator;

    public function __construct(
        PerformanceRepository $performanceRepository,
        PlayerManager $playerManager,
        GameManager $gameManager,
        ValidatorInterface $validator
    ) {
        $this->performanceRepository = $performanceRepository;
        $this->playerManager = $playerManager;
        $this->gameManager = $gameManager;
        $this->validator = $validator;
    }

    public function getAllPerformances(): array
    {
        return $this->performanceRepository->findAll();
    }

    public function addNewPerformance($newPerf): Performance
    {
        $player = $this->playerManager->findPlayerById($newPerf['player']);
        $game = $this->gameManager->findGameById($newPerf['game']);
        $perf = new Performance();
        $perf->setPlayer($player);
        $perf->setGame($game);
        $perf->setPlayerRating($newPerf['rating']);
        if ($this->validator->validate($perf)) {
            return $this->performanceRepository->addPerformance($perf);
        }
    }

    public function findPerformanceById($id): ?Performance
    {
        return $this->performanceRepository->find($id);
    }

    public function editPerformance($editedPerf): Performance
    {
        $perf = $this->performanceRepository->find($editedPerf['perfID']);
        $perf->setPlayerRating($editedPerf['rating']);
        if ($this->validator->validate($perf)) {
            return $this->performanceRepository->addPerformance($perf);
        }
    }

    public function deletePerformance($id)
    {
        $this->performanceRepository->removePerformance($id);
    }
}