<?php

namespace App\Entity;

use App\Repository\KlubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KlubRepository::class)
 */
class Klub
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="klubID")
     */
    private $klubID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naziv;

    /**
     * @ORM\OneToMany(targetEntity=Igrac::class, mappedBy="klub")
     */
    private $igraci;

    /**
     * @ORM\OneToMany(targetEntity=Utakmica::class, mappedBy="domacin")
     */
    private $utakmiceDomacin;

    /**
     * @ORM\OneToMany(targetEntity=Utakmica::class, mappedBy="gost")
     */
    private $utakmiceGost;

    /**
     * @ORM\ManyToOne(targetEntity=Mesto::class, inversedBy="klubovi")
     * @ORM\JoinColumn(nullable=false, name="mestoID", referencedColumnName="mestoID")
     */
    private $mesto;

    public function __construct()
    {
        $this->igraci = new ArrayCollection();
        $this->utakmiceDomacin = new ArrayCollection();
        $this->utakmiceGost = new ArrayCollection();
    }

    public function getKlubID(): ?int
    {
        return $this->klubID;
    }

    public function getNaziv(): ?string
    {
        return $this->naziv;
    }

    public function setNaziv(string $naziv): self
    {
        $this->naziv = $naziv;

        return $this;
    }

    /**
     * @return Collection|Igrac[]
     */
    public function getIgraci(): Collection
    {
        return $this->igraci;
    }

    public function addIgraci(Igrac $igraci): self
    {
        if (!$this->igraci->contains($igraci)) {
            $this->igraci[] = $igraci;
            $igraci->setKlub($this);
        }

        return $this;
    }

    public function removeIgraci(Igrac $igraci): self
    {
        if ($this->igraci->removeElement($igraci)) {
            // set the owning side to null (unless already changed)
            if ($igraci->getKlub() === $this) {
                $igraci->setKlub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Utakmica[]
     */
    public function getUtakmiceDomacin(): Collection
    {
        return $this->utakmiceDomacin;
    }

    public function addUtakmiceDomacin(Utakmica $utakmiceDomacin): self
    {
        if (!$this->utakmiceDomacin->contains($utakmiceDomacin)) {
            $this->utakmiceDomacin[] = $utakmiceDomacin;
            $utakmiceDomacin->setDomacin($this);
        }

        return $this;
    }

    public function removeUtakmiceDomacin(Utakmica $utakmiceDomacin): self
    {
        if ($this->utakmiceDomacin->removeElement($utakmiceDomacin)) {
            // set the owning side to null (unless already changed)
            if ($utakmiceDomacin->getDomacin() === $this) {
                $utakmiceDomacin->setDomacin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Utakmica[]
     */
    public function getUtakmiceGost(): Collection
    {
        return $this->utakmiceGost;
    }

    public function addUtakmiceGost(Utakmica $utakmiceGost): self
    {
        if (!$this->utakmiceGost->contains($utakmiceGost)) {
            $this->utakmiceGost[] = $utakmiceGost;
            $utakmiceGost->setGost($this);
        }

        return $this;
    }

    public function removeUtakmiceGost(Utakmica $utakmiceGost): self
    {
        if ($this->utakmiceGost->removeElement($utakmiceGost)) {
            // set the owning side to null (unless already changed)
            if ($utakmiceGost->getGost() === $this) {
                $utakmiceGost->setGost(null);
            }
        }

        return $this;
    }

    public function getMesto(): ?Mesto
    {
        return $this->mesto;
    }

    public function setMesto(?Mesto $mesto): self
    {
        $this->mesto = $mesto;

        return $this;
    }
}
