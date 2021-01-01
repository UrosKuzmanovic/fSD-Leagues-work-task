<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetitionRepository::class)
 */
class Competition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",name="competitionID")
     */
    private $competitionID;

    /**
     * @ORM\Column(type="string", length=255, name="competitionName")
     */
    private $competitionName;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="competition")
     */
    private $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function getCompetitionID(): ?int
    {
        return $this->competitionID;
    }

    public function getCompetitionName(): ?string
    {
        return $this->competitionName;
    }

    public function setCompetitionName(string $competitionName): self
    {
        $this->competitionName = $competitionName;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setCompetition($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getCompetition() === $this) {
                $game->setCompetition(null);
            }
        }

        return $this;
    }
}
