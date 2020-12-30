<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Position
{
    /**
     * @Assert\Choice(callback="getPositions")
     */
    private $positions;

    public static function getPositions(): array
    {
        return [
            'GK',
            'LB',
            'CB',
            'RB',
            'CDM',
            'CM',
            'LM',
            'RM',
            'CAM',
            'LW',
            'RW',
            'CF',
            'ST',
        ];
    }
}
