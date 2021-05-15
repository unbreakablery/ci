<?php

namespace App\Dice;

/**
 * Class Dice.
 */
class Dice
{
    const FACES = 6;

    protected $roll;

    public function roll(): int
    {
        $this->roll = rand(1, self::FACES);

        return $this->roll;
    }
}
