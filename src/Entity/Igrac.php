<?php

namespace App\Entity;

use App\Repository\IgracRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IgracRepository::class)
 */
class Igrac
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="igracID")
     */
    private $igracID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prezime;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $jmbg;

    /**
     * @ORM\Column(type="date")
     */
    private $datumRodj;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback={"App\Entity\Pozicija", "getPozicije"})
     */
    private $pozicija;

    /**
     * @ORM\ManyToOne(targetEntity=Mesto::class, inversedBy="igraci")
     * @ORM\JoinColumn(nullable=false, name="mestoID", referencedColumnName="mestoID")
     */
    private $mesto;

    /**
     * @ORM\ManyToOne(targetEntity=Klub::class, inversedBy="igraci")
     * @ORM\JoinColumn(nullable=false, name="klubID", referencedColumnName="klubID")
     */
    private $klub;

    /**
     * @ORM\OneToMany(targetEntity=Nastup::class, mappedBy="igrac")
     */
    private $nastupi;

    public function __construct()
    {
        $this->nastupi = new ArrayCollection();
    }

    public function getIgracID(): ?int
    {
        return $this->igracID;
    }

    public function getIme(): ?string
    {
        return $this->ime;
    }

    public function setIme(string $ime): self
    {
        $this->ime = $ime;

        return $this;
    }

    public function getPrezime(): ?string
    {
        return $this->prezime;
    }

    public function setPrezime(string $prezime): self
    {
        $this->prezime = $prezime;

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

    public function getDatumRodj(): ?\DateTimeInterface
    {
        return $this->datumRodj;
    }

    public function setDatumRodj(\DateTimeInterface $datumRodj): self
    {
        $this->datumRodj = $datumRodj;

        return $this;
    }

    public function getPozicija(): ?Pozicija
    {
        return $this->pozicija;
    }

    public function setPozicija(?Pozicija $pozicija): self
    {
        $this->pozicija = $pozicija;

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

    public function getKlub(): ?Klub
    {
        return $this->klub;
    }

    public function setKlub(?Klub $klub): self
    {
        $this->klub = $klub;

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
            $nastupi->setIgrac($this);
        }

        return $this;
    }

    public function removeNastupi(Nastup $nastupi): self
    {
        if ($this->nastupi->removeElement($nastupi)) {
            // set the owning side to null (unless already changed)
            if ($nastupi->getIgrac() === $this) {
                $nastupi->setIgrac(null);
            }
        }

        return $this;
    }
}
