<?php

declare(strict_types=1);

namespace Joki20\Http\Controllers\Yatzy;

use Joki20\Http\Controllers\Dice\Dice;
use Joki20\Http\Controllers\GraphicalDice\GraphicalDice;
use Joki20\Http\Controllers\DiceHand\DiceHand;
use Joki20\Models\Highscore;

// Book class

/**
 * Class Game21.
 */
class Yatzy extends DiceHand
{
    private array $numbers = ["Ettor","Tvåor","Treor","Fyror","Femmor","Sexor"];

    // start game
    public function yatzy()
    {
        session()->has('timesScored') ? session('timesScored') :
            session()->put('timesScored', 0);
        session()->has('rolls') ? session('rolls') :
            session()->put('rolls', 0);
        session()->has('lastRoll') ? session('lastRoll') :
            session()->put('lastRoll', null);
        session()->has('Ettor') ? session('Ettor') :
            session()->put('Ettor', null);
        session()->has('Tvåor') ? session('Tvåor') :
            session()->put('Tvåor', null);
        session()->has('Treor') ? session('Treor') :
            session()->put('Treor', null);
        session()->has('Fyror') ? session('Fyror') :
            session()->put('Fyror', null);
        session()->has('Femmor') ? session('Femmor') :
            session()->put('Femmor', null);
        session()->has('Sexor') ? session('Sexor') :
            session()->put('Sexor', null);
        session()->has('sum') ? session('sum') :
            session()->put('sum', null);
        session()->has('bonus') ? session('bonus') :
            session()->put('bonus', null);
        session()->has('choice') ? session('choice') :
            session()->put('choice', null);

        session()->put('dicehand', new DiceHand(5));

        $form = "";
        $rows = "";

        $start = '
                <!-- Start game -->
                <form method="POST" id="form-roll">
                    <input
                        type="submit"
                        name="status"
                        value="Nytt spel"
                        id="form-roll"
                    >
                </form>
        ';

        echo $start;

        // if post button was pressed:
        //check what kind of post status.
        //Also show points table
        if (isset($_POST["status"])) {
            switch ($_POST["status"]) {
                case "Nytt spel":
                    $this->newGame();
                    echo $this->rollDice();
                    break;
                case "Slå tärningar":
                case "Sparade":
                    echo $this->rollDice();
                    break;
                case "Slå tärningar":
                case "Score":
                    $this->score();
                    echo $this->rollDice();
                    break;
                default:
                    $this->newGame();
                    echo $this->rollDice();
                    break;
            }

            $scoreButton = "";
            if (session('timesScored') < 6) {
                $scoreButton = '<input type="submit" name="status" value="Score">';
            }

            // create all rows 1-6
            foreach ($this->numbers as $number) {
                $rows .= '
                <tr>
                    <td>
                    <input
                        type="radio"
                        name="choice"
                        value="' . $number . '" '
                        . (!is_null(session($number)) ? ' disabled ' : null) . '
                    </td>
                    <td>' . $number . '</td>
                    <td> ' . session($number) . '  </td>
                </tr>
                ';
            }

            $form = '
            <form method="POST">
                <table>
                    <tr>
                        <th>Val</th>
                        <th>Alternativ</th>
                        <th>Poäng</th>
                    </tr>
                    ' . $rows . '
                    <tr><td>Bonus</td><td>' . session('bonus') . '</td></tr>
                    <tr><td>Summa</td><td>' . session('sum') . '</td></tr>
                </table>
                ' . $scoreButton . '
            </form>
            ';
        }
        echo $form;
    }

    public function newGame()
    {
        session()->put('timesScored', 0);
        session()->put('rolls', 0);
        session()->put('lastRoll', null);
        session()->put('Ettor', null);
        session()->put('Tvåor', null);
        session()->put('Treor', null);
        session()->put('Fyror', null);
        session()->put('Femmor', null);
        session()->put('Sexor', null);
        session()->put('sum', null);
        session()->put('bonus', null);
        session()->put('choice', null);
    }

    public function rollDice()
    {
        // +1 to roll
        session()->put('rolls', session('rolls') + 1);


        // WHEN ROLLING, TWO SCENARIOS. 1. NO DICES SAVED, 2. DICES SAVED
        if (session('rolls') <= 3) {
            // 1. NO DICES SAVED
            if (!isset($_POST["Sparade"])) {
                session()->put('lastRoll', session('dicehand')->getRolls());
                // CREATE 5 NUMBER STRING, i.e. 52632
                session()->put('lastRoll', str_replace(", ", "", session('lastRoll')));
            }

            // IF DICES SAVED, REROLL THOSE NOT SAVED
            if (isset($_POST['Sparade'])) {
                // array is created for multiple options
                $savedDiceIndexes = $_POST['Sparade'];
                for ($i = 0; $i < strlen(session('lastRoll')); $i++) {
                        // those dices not saved, reroll them
                    if (!in_array($i, $savedDiceIndexes)) {
                        $lastRoll = session('lastRoll');
                        $lastRoll[$i] = session('dicehand')->roll();
                        session()->put('lastRoll', $lastRoll);
                        // session()->put('lastRoll'[$i], session('dicehand')->roll());
                    }
                }
            }
        }

        $diceRow = "";
        for ($i = 0; $i < strlen(session('lastRoll')); $i++) {
            $diceRow .= '
                <td><p class=dice-utf8><i class=dice-' . session('lastRoll')[$i] . '></i></p></td>';
        };

        $choiceRow = "";
        for ($i = 0; $i < strlen(session('lastRoll')); $i++) {
            $choiceRow .= '
            <td>
                <input type=checkbox name=Sparade[] value=' . $i . '>
            </td>';
        };

        $rollButton = '<input type="submit" name="status" value="Slå tärningar">';
        if (session('rolls') >= 3 || session('timesScored') == 6) {
            $rollButton = '<input type="submit" name="status" value="Slå tärningar" disabled>';
        };



            // DICE CHOICE FOR REROLLS (dice row and choice row)
            return '
                <form method="POST">
                    <table>
                        <tr>' . $diceRow . '</tr>
                        <tr>' . $choiceRow . '</tr>
                    </table> '
               . $rollButton . '
               <br>
                </form>
            ';
    }

    public function score(): string
    {
        session()->put('timesScored', session('timesScored') + 1);
        // If scoring - reset rolls, save score, recalculate sum
        session()->put('rolls', 0);
        // save score
        switch ($_POST["choice"]) {
            case "Ettor":
                session()->put("Ettor", 1 * substr_count(session('lastRoll'), "1"));
                break;
            case "Tvåor":
                session()->put("Tvåor", 2 * substr_count(session('lastRoll'), "2"));
                break;
            case "Treor":
                session()->put("Treor", 3 * substr_count(session('lastRoll'), "3"));
                break;
            case "Fyror":
                session()->put("Fyror", 4 * substr_count(session('lastRoll'), "4"));
                break;
            case "Femmor":
                session()->put("Femmor", 5 * substr_count(session('lastRoll'), "5"));
                break;
            case "Sexor":
                session()->put("Sexor", 6 * substr_count(session('lastRoll'), "6"));
                break;
        }
        // recalculate sum
        session()->put(
            'sum',
            session('Ettor') +
            session('Tvåor') +
            session('Treor') +
            session('Fyror') +
            session('Femmor') +
            session('Sexor')
        );

            // adding bonus
        if (session('sum') >= 63) {
            session()->put('bonus', 50);
        }

         session()->put('sum', session('sum') + session('bonus'));

         // if end of game, add points to highscore table
        if (session('timesScored') == 6) {
            // create Highscore instance
            $highscores = new Highscore();
            // insert score
            $highscores->score = session('sum');
            // save to db
            $highscores->save();
        }

         return '
                 <br>
                 <form method="POST">
                     <input type="submit" name="status" value="Slå tärningar">
                 </form>
         ';
    }
}
