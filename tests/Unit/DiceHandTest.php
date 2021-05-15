<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Dice\DiceHand;

class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObject()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\App\Dice\DiceHand", $diceHand);
    }

    /**
     *test dice roll
     */
    public function testDiceRoll()
    {
        $diceHand = new DiceHand(2);
        $diceHand->roll();
        $res = $diceHand->getSum();
        $this->assertIsInt($res);
    }

    /**
     *test dice get last roll
     */
    public function testGetLastRoll()
    {
        $diceHand = new DiceHand(2);
        $diceHand->roll();
        $res = $diceHand->getLastRoll();
        $this->assertIsArray($res);
    }
}
