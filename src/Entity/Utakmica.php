<?php

namespace App\Entity;

use App\Repository\UtakmicaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtakmicaRepository::class)
 */
class Utakmica
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="utakmicaID")
     */
    private $utakmicaID;

    /**
     * @ORM\Column(type="date", name="datumOdigravanja")
     */
    private $datumOdigravanja;

    /**
     * @ORM\ManyToOne(targetEntity=Takmicenje::class, inversedBy="utakmice")
     * @ORM\JoinColumn(nullable=false, name="takmicenjeID", referencedColumnName="takmicenjeID")
     */
    private $takmicenje;

    /**
     * @ORM\ManyToOne(targetEntity=Klub::class, inversedBy="utakmiceDomacin")
     * @ORM\JoinColumn(nullable=false, name="domacinID", referencedColumnName="klubID")
     */
    private $domacin;

    /**
     * @ORM\ManyToOne(targetEntity=Klub::class, inversedBy="utakmiceGost")
     * @ORM\JoinColumn(nullable=false, name="gostID", referencedColumnName="klubID")
     */
    private $gost;

    /**
     * @ORM\OneToMany(targetEntity=Nastup::class, mappedBy="utakmica")
     */
    private $nastupi;

    public function __construct()
    {
        $this->nastupi = new ArrayCollection();
    }

    public function getUtakmicaID(): ?int
    {
        return $this->utakmicaID;
    }

    public function getDatumOdigravanja(): ?\DateTimeInterface
    {
        return $this->datumOdigravanja;
    }

    public function setDatumOdigravanja(\DateTimeInterface $datumOdigravanja): self
    {
        $this->datumOdigravanja = $datumOdigravanja;

        return $this;
    }

    public function getTakmicenje(): ?Takmicenje
    {
        return $this->takmicenje;
    }

    public function setTakmicenje(?Takmicenje $takmicenje): self
    {
        $this->takmicenje = $takmicenje;

        return $this;
    }

    public function getDomacin(): ?Klub
    {
        return $this->domacin;
    }

    public function setDomacin(?Klub $domacin): self
    {
        $this->domacin = $domacin;

        return $this;
    }

    public function getGost(): ?Klub
    {
        return $this->gost;
    }

    public function setGost(?Klub $gost): self
    {
        $this->gost = $gost;

        return $this;
    }

    /**
     * @return Collection|Nastup[]
     */
    public function getNastupi(): Collection
    {
        return $this->nastupi;
    }

    public function addNastupi(Nastup $nastupi): self
    {
        if (!$this->nastupi->contains($nastupi)) {
            $this->nastupi[] = $nastupi;
            $nastupi->setUtakmica($this);
        }

        return $this;
    }

    public function removeNastupi(Nastup $nastupi): self
    {
        if ($this->nastupi->removeElement($nastupi)) {
            // set the owning side to null (unless already changed)
            if ($nastupi->getUtakmica() === $this) {
                $nastupi->setUtakmica(null);
            }
        }

        return $this;
    }
}
