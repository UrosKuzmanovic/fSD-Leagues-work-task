<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player implements BaseEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="playerID")
     */
    private $playerID;

    /**
     * @ORM\Column(type="string", length=255, name="firstName")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, name="lastName")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $jmbg;

    /**
     * @ORM\Column(type="date", name="dateOfBirth")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback={"App\Entity\Position", "getPositions"})
     */
    private $positions;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false, name="placeID", referencedColumnName="placeID")
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="players")
     * @ORM\JoinColumn(nullable=false, name="clubID", referencedColumnName="clubID")
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity=Performance::class, mappedBy="player")
     */
    private $performances;

    /**
     * @ORM\Column(type="string", length=255, name="photoName")
     */
    private $photoName;

    private $base64;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
    }

    public function getPlayerID(): ?int
    {
        return $this->playerID;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getJmbg(): ?string
    {
        return $this->jmbg;
    }

    public function setJmbg(string $jmbg): self
    {
        $this->jmbg = $jmbg;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getDateOfBirthString(): string
    {
        return $this->dateOfBirth->format('Y-m-d');
    }

    public function getPositions(): ?string
    {
        return $this->positions;
    }

    public function setPositions(string $positions): self
    {
        $this->positions = $positions;

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
            $performance->setPlayer($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->removeElement($performance)) {
            // set the owning side to null (unless already changed)
            if ($performance->getPlayer() === $this) {
                $performance->setPlayer(null);
            }
        }

        return $this;
    }

    public function getPhotoName()
    {
        return $this->photoName;
    }

    public function setPhotoName(string $photoName): void
    {
        $this->photoName = $photoName;
    }

    public function getBase64()
    {
        return $this->base64;
    }

    public function setBase64(string $base64): void
    {
        $this->base64 = $base64;
    }

    public function getId()
    {
        return $this->playerID;
    }

    public function getFullName(): string
    {
        return $this->firstName." ".$this->lastName;
    }

    public function getPlayerDetails(): string
    {
        return $this->firstName." ".$this->lastName." (".$this->getClubName()
            .")";
    }

    public function getClubName(): ?string
    {
        return $this->getClub()->getName();
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }
}
