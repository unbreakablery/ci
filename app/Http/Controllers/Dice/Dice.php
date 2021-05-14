<?php

declare(strict_types=1);

// Folder \Controllers containing classes
namespace Joki20\Http\Controllers\Dice;

/**
 * Class Dice.
 */
class Dice
{
    protected int $sides;
    private ?int $lastRoll;

    // constructor
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    // roll dice
    public function roll(): int
    {
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
    }

    // roll dice
    public function getSides(): int
    {
        return $this->sides;
    }

    // getter
    public function getLastRoll(): int
    {
        return $this->lastRoll;
    }

    // setter
    public function changeSides($sides): string
    {
        // if dice already exists, set new sides
        if ($sides != "start") {
            $this->sides = $sides;
        }
        return "You have a {$this->sides}-sided dice";
    }
}
