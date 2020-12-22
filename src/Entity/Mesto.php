<?php

namespace App\Entity;

use App\Repository\MestoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MestoRepository::class)
 */
class Mesto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="mestoID")
     */
    private $mestoID;

    /**
     * @ORM\Column(type="integer")
     */
    private $ptt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naziv;

    /**
     * @ORM\OneToMany(targetEntity=Igrac::class, mappedBy="mesto")
     */
    private $igraci;

    /**
     * @ORM\OneToMany(targetEntity=Klub::class, mappedBy="mesto")
     */
    private $klubovi;

    public function __construct()
    {
        $this->igraci = new ArrayCollection();
        $this->klubovi = new ArrayCollection();
    }

    public function getMestoID(): ?int
    {
        return $this->mestoID;
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
            $igraci->setMesto($this);
        }

        return $this;
    }

    public function removeIgraci(Igrac $igraci): self
    {
        if ($this->igraci->removeElement($igraci)) {
            // set the owning side to null (unless already changed)
            if ($igraci->getMesto() === $this) {
                $igraci->setMesto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Klub[]
     */
    public function getKlubovi(): Collection
    {
        return $this->klubovi;
    }

    public function addKlubovi(Klub $klubovi): self
    {
        if (!$this->klubovi->contains($klubovi)) {
            $this->klubovi[] = $klubovi;
            $klubovi->setMesto($this);
        }

        return $this;
    }

    public function removeKlubovi(Klub $klubovi): self
    {
        if ($this->klubovi->removeElement($klubovi)) {
            // set the owning side to null (unless already changed)
            if ($klubovi->getMesto() === $this) {
                $klubovi->setMesto(null);
            }
        }

        return $this;
    }
}
