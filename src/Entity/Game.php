<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game implements BaseEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="gameID")
     */
    private $gameID;

    /**
     * @ORM\Column(type="date", name="gameDate")
     */
    private $gameDate;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false, name="competitionID", referencedColumnName="competitionID")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="gamesHome")
     * @ORM\JoinColumn(nullable=false, name="homeID", referencedColumnName="clubID")
     */
    private $home;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="gamesAway")
     * @ORM\JoinColumn(nullable=false, name="awayID", referencedColumnName="clubID")
     */
    private $away;

    /**
     * @ORM\OneToMany(targetEntity=Performance::class, mappedBy="game")
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

    public function getGameID(): ?int
    {
        return $this->gameID;
    }

    public function getGameDate(): ?\DateTimeInterface
    {
        return $this->gameDate;
    }

    public function getGameDateString(): string
    {
        return $this->gameDate->format('Y-m-d');
    }

    public function setGameDate(\DateTimeInterface $gameDate): self
    {
        $this->gameDate = $gameDate;

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
            $performance->setGame($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getGame() === $this) {
                $performance->setGame(null);
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

    public function getInverseResult(): string
    {
        return $this->awayClubGoals." - ".$this->homeClubGoals;
    }

    public function getClubsPlayed(): string
    {
        return $this->getHome()->getName()." vs ".$this->getAway()->getName();
    }

    public function getHomeID(): ?int
    {
        return $this->getHome()->getClubID();
    }

    public function getAwayID(): ?int
    {
        return $this->getAway()->getClubID();
    }

    public function getGameDetails(): string
    {
        return $this->getHome()->getName()." vs ".$this->getAway()->getName()." ".$this->getResult()." (".$this->getGameDateString().")";
    }

    public function getId()
    {
        return $this->gameID;
    }
}
