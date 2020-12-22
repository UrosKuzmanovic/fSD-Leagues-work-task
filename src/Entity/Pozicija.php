<?php

namespace App\Entity;

use App\Repository\PozicijaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Pozicija
{
    /**
     * @Assert\Choice(callback="getNaziv")
     */
    private $pozicija;

    private static function getPozicije(){
        return [];
    }
}
