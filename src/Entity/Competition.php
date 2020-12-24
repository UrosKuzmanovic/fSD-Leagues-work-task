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
     * @ORM\OneToMany(targetEntity=Match::class, mappedBy="competition")
     */
    private $matches;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
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
     * @return Collection|Match[]
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Match $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setCompetition($this);
        }

        return $this;
    }

    public function removeMatch(Match $match): self
    {
        if ($this->matches->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getCompetition() === $this) {
                $match->setCompetition(null);
            }
        }

        return $this;
    }
}
