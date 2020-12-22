<?php

namespace App\Entity;

use App\Repository\NastupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NastupRepository::class)
 */
class Nastup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="nastupID")
     */
    private $nastupID;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, name="ocenaIgraca")
     */
    private $ocenaIgraca;

    /**
     * @ORM\ManyToOne(targetEntity=Igrac::class, inversedBy="nastupi")
     * @ORM\JoinColumn(nullable=false, name="igracID", referencedColumnName="igracID")
     */
    private $igrac;

    /**
     * @ORM\ManyToOne(targetEntity=Utakmica::class, inversedBy="nastupi")
     * @ORM\JoinColumn(nullable=false, name="utakmicaID", referencedColumnName="utakmicaID")
     */
    private $utakmica;

    public function getNastupID(): ?int
    {
        return $this->nastupID;
    }

    public function getOcenaIgraca(): ?string
    {
        return $this->ocenaIgraca;
    }

    public function setOcenaIgraca(string $ocenaIgraca): self
    {
        $this->ocenaIgraca = $ocenaIgraca;

        return $this;
    }

    public function getIgrac(): ?Igrac
    {
        return $this->igrac;
    }

    public function setIgrac(?Igrac $igrac): self
    {
        $this->igrac = $igrac;

        return $this;
    }

    public function getUtakmica(): ?Utakmica
    {
        return $this->utakmica;
    }

    public function setUtakmica(?Utakmica $utakmica): self
    {
        $this->utakmica = $utakmica;

        return $this;
    }
}
