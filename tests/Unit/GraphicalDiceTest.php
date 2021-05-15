<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Dice\GraphicalDice;

class GraphicalDiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObject()
    {
        $dice = new GraphicalDice();
        $this->assertInstanceOf("\App\Dice\GraphicalDice", $dice);
    }

    /**
     *test dice roll
     */
    public function testDiceRoll()
    {
        $dice = new GraphicalDice();
        $res = $dice->roll();
        $this->assertIsInt($res);
    }

    /**
     *test get last roll
     */
    public function testGetLastRoll()
    {
        $dice = new GraphicalDice();
        $dice->roll();
        $res = $dice->getLastRoll();
        $this->assertIsInt($res);
    }
}
