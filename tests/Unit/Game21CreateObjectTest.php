<?php

namespace Tests\Unit;

use Tests\TestCase;
use Joki20\Http\Controllers\Dice\Dice;
use Joki20\Http\Controllers\DiceHand\DiceHand;
use Joki20\Http\Controllers\Game21\Game21;

/**
 * Test cases for class Guess.
 */
class Game21CreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object is instance of Game21 class
     */
    public function testCreateGame21()
    {
        $game = new Game21();
        $this->assertInstanceOf("Joki20\Http\Controllers\Game21\Game21", $game);

        $res = $game->game21();
        $exp = "";
        $this->assertEquals($res, $exp);

        $_POST["status"] = "Starta spelet";
        $res = $game->game21();
        $exp = $game->chooseNrOfDice();
        $this->assertEquals($res, $exp);

        // some kind of error getRolls() here
        $_POST["status"] = "Slå tärning";
        session()->put('diceHand', new DiceHand(1));
        $res = $game->game21();
        $exp = $game->playerTurn();
        $this->assertEquals($res, $exp);

        $_POST["status"] = "Stanna";
        $res = $game->game21();
        $exp = $game->playerStopped();
        $this->assertEquals($res, $exp);

        $_POST["status"] = "Computer turn";
        $res = $game->game21();
        $exp = $game->computerTurn();
        $this->assertEquals($res, $exp);

        $_POST["status"] = "Something irrelevant";
        $res = $game->game21();
        $exp = $game->chooseNrOfDice();
        $this->assertEquals($res, $exp);
    }

    public function testChooseNrOfDice()
    {
        $game = new Game21();
        $this->assertInstanceOf("Joki20\Http\Controllers\Game21\Game21", $game);

        $res = $game->chooseNrOfDice();
        $exp = '
        <!-- 2. CHOOSE 1 OR 2 DICES -->
        <h2>Välj antal tärningar att spela med</p>

        <!-- 1 die -->
        <form method="POST">
            <input
                type="submit" name="status" value=1>
        </form>

        <!-- 2 dice -->
        <form method="POST">
            <input
                type="submit" name="status" value=2>
        </form>
        ';
        $this->assertEquals($res, $exp);
    }

    public function testPlayerTurn()
    {
        $game = new Game21();
        $this->assertInstanceOf("Joki20\Http\Controllers\Game21\Game21", $game);

        $_POST["status"] = 1;
        session()->put('playerScore', 0);
        session()->put('playerRolls', 0);
        $res = $game->playerTurn();
        $exp = '
            <!-- 6. ROLL DICE -->
            <form method="POST">
                <input
                    type="submit" name="status" value="Slå tärning">
            </form>
            <br>

            <!-- 7. OR STOP -->
            <form method="POST">
                <input
                    type="submit" name="status" value="Stanna">
            </form>
            ';

        $this->assertEquals($exp, $res);

        // score is over 21
        session()->put('playerScore', 22);
        $res = $game->playerTurn();
        $exp = '<p>SUMMA: ' . session('playerScore') . '</p><p>GAME OVER!</p>';
        $this->assertEquals($exp, $res);

        // score is 21
        session()->put('playerScore', 21);
        $res = $game->playerTurn();
        $exp = '
                <p>SLUTPOÄNG: ' . session('playerScore') . '</p><p>GRATTIS!! :)</p>
                <br><br>
                <!-- 8. COMPUTER\'s TURN -->
                <form method="POST">
                    <input
                        type="submit" name="status" value="Computer turn">
                </form>
                ';
        $this->assertEquals($exp, $res);

        // score is less than 21
        session()->put('playerScore', 21);
        $res = $game->playerTurn();
        $exp = '
                <p>SLUTPOÄNG: ' . session('playerScore') . '</p><p>GRATTIS!! :)</p>
                <br><br>
                <!-- 8. COMPUTER\'s TURN -->
                <form method="POST">
                    <input
                        type="submit" name="status" value="Computer turn">
                </form>
                ';
        $this->assertEquals($exp, $res);
    }

    public function testPlayerStopped()
    {
        $game = new Game21();
        $this->assertInstanceOf("Joki20\Http\Controllers\Game21\Game21", $game);

        $res = $game->playerStopped();
        $exp = '
            <br><br>
            <!-- 8. COMPUTER\'s TURN -->
            <form method="POST">
                <input
                    type="submit" name="status" value="Computer turn">
            </form>
        ';
        $this->assertEquals($exp, $res);
    }


    public function testComputerTurn()
    {
        $game = new Game21();
        $this->assertInstanceOf("Joki20\Http\Controllers\Game21\Game21", $game);
        session()->put('computerScore', 22);
        session()->put('playerScore', 21);

        $res = $game->computerTurn();
        $exp = '
            YOU WON with score ' . session('playerScore') . ',
            computer rolled over 21.</p>
            <p>You rolled ' . session('playerRolls') . ' times</p>
            ';
        $this->assertEquals($exp, $res);


         session()->put('computerScore', 21);
         session()->put('computerRolls', 3);
         $res = $game->computerTurn();
         $exp = '
                <p>Computer won with score ' . session('computerScore') . ' vs
                your score ' . session('playerScore') . '.</p>
                <p>You rolled ' . session('playerRolls') . ' times.</p>
                <p>Computer rolled ' . session('computerRolls') . ' times</p>
                ';
          $this->assertEquals($exp, $res);
    }
}
