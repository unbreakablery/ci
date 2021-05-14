<?php

declare(strict_types=1);

namespace Joki20\Http\Controllers\GraphicalDice;

use Joki20\Http\Controllers\Dice\Dice;

/**
 * Class Dice.
 */
class GraphicalDice extends Dice
{
    private $rolls = 1;
    const SIDES = 6;

    /**
    * Constructor to initiate the dice with six number of sides.
    */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    public function getRolls(): int
    {
        return $this->rolls;
    }

    public function graphic(): string
    {
        $res = [];
        $class = [];
        $output = "";
        for ($i = 0; $i < $this->getRolls(); $i++) {
            $res[$i] = $this->roll();
            $class[$i] = 'dice-sprite dice' . $this->getLastRoll();
            $output .= '<i class=\'' . $class[$i] . '\'></i>';
        }
        return '<p class=\'dice-utf8\'>' . $output . '</p>';
    }
}

// * Skapa en klass GraphicalDice.
// * Den kan göra allt som Dice kan plus att den även kan ha en grafisk representation som visar upp en tärning.
// * Denna tärning skall ha 6 sidor.
