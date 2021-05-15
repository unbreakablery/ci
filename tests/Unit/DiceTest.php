<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Dice\Dice;

class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $dice);
    }

    /**
     *test dice roll
     */
    public function testDiceRoll()
    {
        $dice = new Dice();
        $res = $dice->roll();
        $this->assertIsInt($res);
    }
}
