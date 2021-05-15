<?php

namespace App\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    protected $dices;
    protected $cntDices;

    public function __construct($cnt = 2)
    {
        $this->cntDices = $cnt;

        for ($i = 0; $i < $this->cntDices; $i++) {
            $this->dices[$i] = new GraphicalDice();
        }
    }

    public function roll(): void
    {
        for ($i = 0; $i < $this->cntDices; $i++) {
            $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): array
    {
        $res = array();
        for ($i = 0; $i < $this->cntDices; $i++) {
            array_push($res, $this->dices[$i]->getLastRoll());
        }

        return $res;
    }

    public function getLastRollImages(): array
    {
        $res = array();
        for ($i = 0; $i < $this->cntDices; $i++) {
            array_push($res, "<img class='rotate" . $this->dices[$i]->getLastRoll() . "' src='" . asset("/images/" . $this->dices[$i]->getLastRoll() . ".png") . "' width='100' />");
        }

        return $res;
    }

    public function getSum(): int
    {
        $sum = 0;
        $lastRolls = $this->getLastRoll();
        foreach($lastRolls as $roll) {
            $sum += $roll;
        }
        
        return $sum;
    }
}
