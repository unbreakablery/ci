<?php

declare(strict_types=1);

namespace Joki20\Http\Controllers\DiceHand;

use Joki20\Http\Controllers\Dice\Dice;
use Joki20\Http\Controllers\GraphicalDice\GraphicalDice;

/**
 * Class Dice.
 */
class DiceHand extends Dice
{
    // ? allows null values to be used
    private $rolls = null;
    private $dices = [];
    private $values = [];

    public function __construct(int $rolls = null)
    {
        $this->rolls = $rolls;
        $this->dices = [];
        $this->values = [];
        $this->sides = 6; // otherwise undefined when roll() called

        for ($i = 0; $i < $this->rolls; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = null;
        }
    }

    // getter
    public function getDices(): array
    {
        return $this->dices; // array to string
    }

    // getter
    public function getRolls(): string
    {
        for ($i = 0; $i < $this->rolls; $i++) {
            $this->dices[$i]->roll(); // roll die
            $this->values[$i] = $this->dices[$i]->getLastRoll(); // save result
        }
        return implode(", ", $this->values); // array to string
    }

    // setter
    public function changeRolls($rolls): int
    {
        $this->rolls = $rolls;
        return $this->rolls;
    }
}

// * Skapa en klass DiceHand som kan innehålla ett antal tärningar.
// * Man kan konfigurera objektet hur många tärningar det skall innehålla.
// * Man kan rulla alla tärningar på en gång.
// * Man kan hämta värdena på de rullade tärningarna. -->
