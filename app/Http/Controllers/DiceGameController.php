<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dice\DiceHand;
use App\Models\HighScores;
use App\Models\History;
use App\Models\Settings;

class DiceGameController extends Controller
{   
    public function initSessionGame21()
    {
        session([
                    'cnt-dices'         => 2,
                    'bet-amount'        => 0,
                    'your-points'       => 0,
                    'computer-points'   => 0,
                    'game-ended'        => false
                ]);
    }
    public function clearSessionGame21()
    {
        session([
                    'cnt-dices'         => 2,
                    'bet-amount'        => 0,
                    'your-points'       => 0,
                    'computer-points'   => 0,
                    'game-ended'        => false
                ]);
        History::truncate();
        Settings::where('id', 1)
                ->update([
                    'coin1' => 10,
                    'coin2' => 100
                ]);
    }
    public function saveSettingGame21($cntDices, $betAmount)
    {
        session([
                    'cnt-dices'     => $cntDices,
                    'bet-amount'    => $betAmount
                ]);
    }
    public function setPoints($turn, $points)
    {
        $current_points = session($turn);
        session([$turn => $current_points + $points]);
    }
    public function getWinner()
    {
        $yourPoints = session('your-points');
        $computerPoints = session('computer-points');

        if ($yourPoints == 21) {
            return 'You';
        } elseif ($yourPoints > 21) {
            return 'Computer';
        } elseif ($computerPoints == 21) {
            return 'Computer';
        } elseif ($computerPoints > 21) {
            return 'You';
        } elseif ($yourPoints > $computerPoints) {
            return 'You';
        }

        return 'Computer';
    }
    public function checkYourPoints()
    {
        $yourPoints = session('your-points');

        if ($yourPoints == 21) {
            session(['game-ended' => true]);
            return 'You Won!';
        } elseif ($yourPoints > 21) {
            session(['game-ended' => true]);
            return 'You lose!';
        }
        return '';
    }
    public function updateBalance($winner, $betAmount) {
        $settings = Settings::get()->first();
        
        Settings::where('id', 1)
                ->update([
                    'coin1' => ($winner == 'You') ? $settings->coin1 + $betAmount : $settings->coin1 - $betAmount,
                    'coin2' => ($winner == 'Computer') ? $settings->coin2 + $betAmount : $settings->coin2 - $betAmount
                ]);
    }
    public function updateHistory($winner)
    {
        $history = new History();
        $history->date = date('Y-m-d H:i:s');
        $history->winner = $winner;
        $history->point1 = session('your-points');
        $history->point2 = session('computer-points');
        $history->bet_amount = session('bet-amount');
        $history->save();
    }
    public function getHighScore()
    {
        $maxScore = HighScores::max('score');
        return ($maxScore == null) ? 0 : $maxScore;
    }
    public function saveHighScore($player, $score)
    {
        HighScores::insert([
                                'date'      => date('Y-m-d H:i:s'),
                                'player'    => $player,
                                'score'     => $score
                            ]);
    }
    public function getWins($player = 'You') {
        return History::where('winner', $player)
                    ->count();
    }
    public function index() 
    {
        $settings = Settings::get()->first();
        $this->initSessionGame21();

        return view('game21.setting', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected',
            'settings'          => $settings
        ]);
    }
    public function saveSetting(Request $request)
    {
        $cntDices = $request->input('cnt-dices');
        $yourBetAmount = $request->input('bet-amount');
        
        Settings::where('id', 1)
                ->update([
                    'cnt_dices' => $cntDices
                ]);

        $settings = Settings::get()->first();
        $computerBetAmount = rand(0, 50) / 100 * $settings->coin2;
        $betAmount = ($yourBetAmount < $computerBetAmount) ? $yourBetAmount : $computerBetAmount;

        $this->initSessionGame21();
        $this->saveSettingGame21($cntDices, $betAmount);

        $your_wins = $this->getWins('You');
        $computer_wins = $this->getWins('Computer');
        
        return view('game21.start', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected',
            'yourPoints'        => session('your-points'),
            'computerPoints'    => session('computer-points'),
            'yourWins'          => $your_wins,
            'computerWins'      => $computer_wins,
            'yourBalance'       => $settings->coin1,
            'computerBalance'   => $settings->coin2,
            'yourBetAmount'     => $yourBetAmount,
            'computerBetAmount' => $computerBetAmount,
            'betAmount'         => $betAmount
        ]);
    }
    public function playRoll()
    {   
        if (session('game-ended')) {
            return redirect()->route('game21-view-result');
        }

        $cntDices = session('cnt-dices');
        
        $diceHand = new DiceHand($cntDices);
        $diceHand->roll();
        $this->setPoints('your-points', $diceHand->getSum());
        $diceImgs = $diceHand->getLastRollImages();

        $message = $this->checkYourPoints();

        return view('game21.dice', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected',
            'yourPoints'        => session('your-points'),
            'computerPoints'    => session('computer-points'),
            'points'            => $diceHand->getSum(),
            'diceImgs'          => $diceImgs,
            'message'           => $message,
            'gameEnded'         => session('game-ended')
        ]);
    }
    public function playComputer()
    {
        $computerPoints = rand(16, 32);
        $this->setPoints('computer-points', $computerPoints);
        session(['game-ended' => true]);
        
        return redirect()->route('game21-view-result');
    }
    public function viewResult()
    {
        if (!session('game-ended')) {
            return redirect()->route('game21-view-history');
        }
        $winner = $this->getWinner();
        $message = '';
        $maxScore = $this->getHighScore();
        $highScoreMsg = '';

        if ($winner == 'You') {
            $message = 'You Won!';
            if ($maxScore < session('your-points')) {
                $this->saveHighScore('You', session('your-points'));
                $highScoreMsg = 'You got high score!';
            }
        } elseif ($winner == 'Computer') {
            $message = 'You Lose!';
            if ($maxScore < session('computer-points')) {
                $this->saveHighScore('Computer', session('computer-points'));
                $highScoreMsg = 'Computer got high score!';
            }
        } else {
            return redirect()->route('game21-view-history');
        }
        
        $this->updateBalance($winner, session('bet-amount'));
        $this->updateHistory($winner);

        $settings = Settings::get()->first();
        
        return view('game21.result', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected',
            'yourPoints'        => session('your-points'),
            'computerPoints'    => session('computer-points'),
            'yourWins'          => $this->getWins('You'),
            'computerWins'      => $this->getWins('Computer'),
            'message'           => $message,
            'highScoreMsg'      => $highScoreMsg,
            'yourBalance'       => $settings->coin1,
            'computerBalance'   => $settings->coin2
        ]);
    }
    public function viewHistory()
    {
        $settings = Settings::get()->first();

        $history = History::orderBy('date', 'DESC')
                        ->get();
        
        return view('game21.history', [
            'pageName'          => 'Game21',
            'menuHistoryClass'  => 'selected',
            'yourWins'          => $this->getWins('You'),
            'computerWins'      => $this->getWins('Computer'),
            'yourBalance'       => $settings->coin1,
            'computerBalance'   => $settings->coin2,
            'history'           => $history
        ]);
    }
    public function clearHistory()
    {
        $this->clearSessionGame21();

        return redirect()->route('game21');
    }
    public function viewHighScores()
    {
        $highScores = HighScores::orderBy('score', 'DESC')->get();

        return view('game21.highscores', [
            'pageName'              => 'Game21',
            'menuHighscoresClass'   => 'selected',
            'highScores'            => $highScores
        ]);
    }
    public function clearHighScores()
    {
        HighScores::truncate();
        return view('game21.highscores', [
            'pageName'              => 'Game21',
            'menuHighscoresClass'   => 'selected',
            'highScores'            => []
        ]);
    }
    public function viewHelp()
    {
        return view('game21.help', [
            'pageName'      => 'Help - Game21',
            'menuHelpClass' => 'selected'
        ]);
    }
}
