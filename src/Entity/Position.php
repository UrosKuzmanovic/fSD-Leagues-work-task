<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Position
{
    /**
     * @Assert\Choice(callback="getPositions")
     */
    private $positions;

    private static function getPositions(){
        return [];
    }
}
