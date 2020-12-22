<?php

namespace App\Entity;

use App\Repository\TakmicenjeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TakmicenjeRepository::class)
 */
class Takmicenje
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",name="takmicenjeID")
     */
    private $takmicenjeID;

    /**
     * @ORM\Column(type="string", length=255, name="nazivTakmicenja")
     */
    private $nazivTakmicenja;

    /**
     * @ORM\OneToMany(targetEntity=Utakmica::class, mappedBy="takmicenje")
     */
    private $utakmice;

    public function __construct()
    {
        $this->utakmice = new ArrayCollection();
    }

    public function getTakmicenjeID(): ?int
    {
        return $this->takmicenjeID;
    }

    public function getNazivTakmicenja(): ?string
    {
        return $this->nazivTakmicenja;
    }

    public function setNazivTakmicenja(string $nazivTakmicenja): self
    {
        $this->nazivTakmicenja = $nazivTakmicenja;

        return $this;
    }

    /**
     * @return Collection|Utakmica[]
     */
    public function getUtakmice(): Collection
    {
        return $this->utakmice;
    }

    public function addUtakmica(Utakmica $utakmica): self
    {
        if (!$this->utakmice->contains($utakmica)) {
            $this->utakmice[] = $utakmica;
            $utakmica->setTakmicenje($this);
        }

        return $this;
    }

    public function removeUtakmica(Utakmica $utakmica): self
    {
        if ($this->utakmice->removeElement($utakmica)) {
            // set the owning side to null (unless already changed)
            if ($utakmica->getTakmicenje() === $this) {
                $utakmica->setTakmicenje(null);
            }
        }

        return $this;
    }
}
