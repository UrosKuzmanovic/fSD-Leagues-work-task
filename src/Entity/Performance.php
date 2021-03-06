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
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="performances")
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="performances")
     * @ORM\JoinColumn(nullable=false, name="gameID", referencedColumnName="gameID")
     */
    private $game;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $createdBy;

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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
