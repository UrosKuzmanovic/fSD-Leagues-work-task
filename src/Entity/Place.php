<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place implements BaseEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="placeID")
     */
    private $placeID;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $ptt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="place")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Club::class, mappedBy="place")
     */
    private $clubs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $createdBy;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->clubs = new ArrayCollection();
    }

    public function getPlaceID(): ?int
    {
        return $this->placeID;
    }

    public function getPtt(): ?int
    {
        return $this->ptt;
    }

    public function setPtt(int $ptt): self
    {
        $this->ptt = $ptt;

        return $this;
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
            $player->setPlace($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getPlace() === $this) {
                $player->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
            $club->setPlace($this);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->clubs->removeElement($club)) {
            // set the owning side to null (unless already changed)
            if ($club->getPlace() === $this) {
                $club->setPlace(null);
            }
        }

        return $this;
    }

    public function getId()
    {
        return $this->placeID;
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
