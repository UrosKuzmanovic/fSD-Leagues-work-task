<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerformanceRepository::class)
 */
class Performance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="performanceID")
     */
    private $performanceID;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, name="playerRating")
     */
    private $playerRating;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="performances")
     * @ORM\JoinColumn(nullable=false, name="playerID", referencedColumnName="playerID")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Match::class, inversedBy="performances")
     * @ORM\JoinColumn(nullable=false, name="matchID", referencedColumnName="matchID")
     */
    private $match;

    public function getPerformanceID(): ?int
    {
        return $this->performanceID;
    }

    public function getPlayerRating(): ?string
    {
        return $this->playerRating;
    }

    public function setPlayerRating(string $playerRating): self
    {
        $this->playerRating = $playerRating;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getMatch(): ?Match
    {
        return $this->match;
    }

    public function setMatch(?Match $match): self
    {
        $this->match = $match;

        return $this;
    }
}
