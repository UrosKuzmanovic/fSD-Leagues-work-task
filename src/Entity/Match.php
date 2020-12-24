<?php

namespace App\Entity;

use App\Repository\MatchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="matchID")
     */
    private $matchID;

    /**
     * @ORM\Column(type="date", name="matchDate")
     */
    private $matchDate;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class, inversedBy="matches")
     * @ORM\JoinColumn(nullable=false, name="competitionID", referencedColumnName="competitionID")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="matchesHome")
     * @ORM\JoinColumn(nullable=false, name="homeID", referencedColumnName="clubID")
     */
    private $home;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="matchesAway")
     * @ORM\JoinColumn(nullable=false, name="awayID", referencedColumnName="clubID")
     */
    private $away;

    /**
     * @ORM\OneToMany(targetEntity=Performance::class, mappedBy="match")
     */
    private $performances;

    /**
     * @ORM\Column(type="integer", name="homeClubGoals")
     */
    private $homeClubGoals;

    /**
     * @ORM\Column(type="integer", name="awayClubGoals")
     */
    private $awayClubGoals;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
    }

    public function getMatchID(): ?int
    {
        return $this->matchID;
    }

    public function getMatchDate(): ?\DateTimeInterface
    {
        return $this->matchDate;
    }

    public function setMatchDate(\DateTimeInterface $matchDate): self
    {
        $this->matchDate = $matchDate;

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }

    public function getHome(): ?Club
    {
        return $this->home;
    }

    public function setHome(?Club $home): self
    {
        $this->home = $home;

        return $this;
    }

    public function getAway(): ?Club
    {
        return $this->away;
    }

    public function setAway(?Club $away): self
    {
        $this->away = $away;

        return $this;
    }

    /**
     * @return Collection|Performance[]
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performances->contains($performance)) {
            $this->performances[] = $performance;
            $performance->setMatch($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getMatch() === $this) {
                $performance->setMatch(null);
            }
        }

        return $this;
    }

    public function getHomeClubGoals(): ?int
    {
        return $this->homeClubGoals;
    }

    public function setHomeClubGoals(int $homeClubGoals): self
    {
        $this->homeClubGoals = $homeClubGoals;

        return $this;
    }

    public function getAwayClubGoals(): ?int
    {
        return $this->awayClubGoals;
    }

    public function setAwayClubGoals(int $awayClubGoals): self
    {
        $this->awayClubGoals = $awayClubGoals;

        return $this;
    }

    public function getResult(): string
    {
      return $this->homeClubGoals." - ".$this->awayClubGoals;
    }
}
