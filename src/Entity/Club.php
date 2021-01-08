<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club implements BaseEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="clubID")
     */
    private $clubID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="club")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="home")
     */
    private $gamesHome;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="away")
     */
    private $gamesAway;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="clubs")
     * @ORM\JoinColumn(nullable=false, name="placeID", referencedColumnName="placeID")
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $createdBy;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->gamesHome = new ArrayCollection();
        $this->gamesAway = new ArrayCollection();
    }

    public function getClubID(): ?int
    {
        return $this->clubID;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setClub($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getClub() === $this) {
                $player->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGamesHome(): Collection
    {
        return $this->gamesHome;
    }

    public function addGameHome(Game $game): self
    {
        if (!$this->gamesHome->contains($game)) {
            $this->gamesHome[] = $game;
            $game->setHome($this);
        }

        return $this;
    }

    public function removeGameHome(Game $game): self
    {
        if ($this->gamesHome->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getHome() === $this) {
                $game->setHome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGamesAway(): Collection
    {
        return $this->gamesAway;
    }

    public function addGameAway(Game $game): self
    {
        if (!$this->gamesAway->contains($game)) {
            $this->gamesAway[] = $game;
            $game->setAway($this);
        }

        return $this;
    }

    public function removeGameAway(Game $game): self
    {
        if ($this->gamesAway->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getAway() === $this) {
                $game->setAway(null);
            }
        }

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getId()
    {
        return $this->clubID;
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
