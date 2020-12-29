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
     * @ORM\OneToMany(targetEntity=Match::class, mappedBy="home")
     */
    private $matchesHome;

    /**
     * @ORM\OneToMany(targetEntity=Match::class, mappedBy="away")
     */
    private $matchesAway;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="clubs")
     * @ORM\JoinColumn(nullable=false, name="placeID", referencedColumnName="placeID")
     */
    private $place;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->matchesHome = new ArrayCollection();
        $this->matchesAway = new ArrayCollection();
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
     * @return Collection|Match[]
     */
    public function getMatchesHome(): Collection
    {
        return $this->matchesHome;
    }

    public function addMatchHome(Match $match): self
    {
        if (!$this->matchesHome->contains($match)) {
            $this->matchesHome[] = $match;
            $match->setHome($this);
        }

        return $this;
    }

    public function removeMatchHome(Match $match): self
    {
        if ($this->matchesHome->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getHome() === $this) {
                $match->setHome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Match[]
     */
    public function getMatchesAway(): Collection
    {
        return $this->matchesAway;
    }

    public function addMatchAway(Match $match): self
    {
        if (!$this->matchesAway->contains($match)) {
            $this->matchesAway[] = $match;
            $match->setAway($this);
        }

        return $this;
    }

    public function removeMatchAway(Match $match): self
    {
        if ($this->matchesAway->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getAway() === $this) {
                $match->setAway(null);
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
}
