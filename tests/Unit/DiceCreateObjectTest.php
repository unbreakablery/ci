<?php

// php artisan test
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Joki20\Http\Controllers\Dice\Dice;

/**
 * Test cases for class Guess.
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object is instance of Dice class
     */
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Joki20\Http\Controllers\Dice\Dice", $dice);
    }

    /**
     * Construct object and verify that the sides of dice has been changed
     */
    public function testCreateObjectChangeSides()
    {

        $dice = new Dice();
        $this->assertInstanceOf("\Joki20\Http\Controllers\Dice\Dice", $dice);

        $res = $dice->changeSides(12);
        $exp = "You have a 12-sided dice";
        $this->assertEquals($exp, $res);

        $res = $dice->getSides();
        $exp = 12;
        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectGetLastRoll()
    {
        $dice = new Dice();
        $this->assertInstanceOf("Joki20\Http\Controllers\Dice\Dice", $dice);

        $dice->roll();
        $res = $dice->getLastRoll();
        $exp = $dice->getLastRoll();

        $this->assertEquals($exp, $res);
    }
}
