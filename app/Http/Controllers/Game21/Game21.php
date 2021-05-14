<?php

declare(strict_types=1);

namespace Joki20\Http\Controllers\Game21;

use Joki20\Http\Controllers\Dice\Dice;
use Joki20\Http\Controllers\GraphicalDice\GraphicalDice;
use Joki20\Http\Controllers\DiceHand\DiceHand;

/**
 * Class Game21.
 */
class Game21 extends DiceHand
{

    public function game21(): string
    {

        $start = '<form method="POST" id="form-roll">
                    <input
                        type="submit"
                        name="status"
                        value="Starta spelet"
                        id="form-roll"
                        >
                </form>
                ';

        echo $start;

        if (isset($_POST["status"])) {
            switch ($_POST["status"]) {
                case "Starta spelet":
                    return $this->chooseNrOfDice();
                case 1:
                case 2:
                case "Slå tärning":
                    return $this->playerTurn();
                case "Stanna":
                    return $this->playerStopped();
                case "Computer turn":
                    return $this->computerTurn();
                default:
                    return $this->chooseNrOfDice();
            }
        }
        // if not $_POST is set, return empty string
        return "";
    }

    public function chooseNrOfDice(): string
    {
        session()->put('playerScore', 0);
        session()->put('computerScore', 0);
        session()->put('playerRolls', 0);
        session()->put('computerRolls', 0);

        return '
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
    }

    public function playerTurn(): string
    {
        // if 1 or 2 dice choice, set DiceHand
        if ($_POST["status"] == 1 || $_POST["status"] == 2) {
            $nrDices = (int)$_POST["status"];
            //session(['diceHand' => new DiceHand($nrDices)]);
            session()->put('diceHand', new DiceHand($nrDices));
        }

        // if a roll occurred, show result of roll and add 1 to roll
        if ($_POST["status"] == "Slå tärning") {
            $rollResult = session('diceHand')->getRolls();

            echo $rollResult; // show result of dice

            $diceArray = explode(", ", $rollResult);
            session()->put('playerScore', session('playerScore') + array_sum($diceArray));
            // session(['playerScore' =>  session('playerScore') + array_sum($diceArray)]);
            //$_SESSION["playerScore"] += array_sum($diceArray);
            session()->put('playerRolls', session('playerRolls') + 1);
        }

        // if score is less than 21, decide if to roll or stop
        if (session('playerScore') < 21) {
            echo '<p>SUMMA: ' . session('playerScore') . '</p>';

            return '
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
        }

        if (session('playerScore') > 21) {
            // if more than 21, game ends and you lose (computer doesn't play)
            return '<p>SUMMA: ' . session('playerScore') . '</p><p>GAME OVER!</p>';
        }
    // if exactly 21
        return '
                <p>SLUTPOÄNG: ' . session('playerScore') . '</p><p>GRATTIS!! :)</p>
                <br><br>
                <!-- 8. COMPUTER\'s TURN -->
                <form method="POST">
                    <input
                        type="submit" name="status" value="Computer turn">
                </form>
                ';
    }


    public function playerStopped(): string
    {
        return '
            <br><br>
            <!-- 8. COMPUTER\'s TURN -->
            <form method="POST">
                <input
                    type="submit" name="status" value="Computer turn">
            </form>
        ';
    }

    public function computerTurn(): string
    {
        // if computer score is less than your score, continue rolling
        while (session('computerScore') < session('playerScore')) {
            $rollResult = session('diceHand')->getRolls();
            $diceArray = explode(", ", $rollResult); // converts string of dice results to array
            session()->put('computerScore', session('computerScore') + array_sum($diceArray));
            session()->put('computerRolls', session('computerRolls') + 1);
        }

        if (session('computerScore') > 21) {
            return '
            YOU WON with score ' . session('playerScore') . ',
            computer rolled over 21.</p>
            <p>You rolled ' . session('playerRolls') . ' times</p>
            ';
        }

        // if computer stopped at or before 21, it means it won over the player
        return '
                <p>Computer won with score ' . session('computerScore') . ' vs
                your score ' . session('playerScore') . '.</p>
                <p>You rolled ' . session('playerRolls') . ' times.</p>
                <p>Computer rolled ' . session('computerRolls') . ' times</p>
                ';
    }
}
