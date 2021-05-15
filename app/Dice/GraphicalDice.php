<?php

namespace App\Dice;

/**
 * Class GraphicalDice.
 */
class GraphicalDice extends Dice
{
    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
