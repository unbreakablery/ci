<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dice\DiceHand;
use App\Models\HighScores;

use DateTime;

class DiceGameController extends Controller
{   
    protected function initSessionGame21()
    {
        session([
                    'cnt-dices'         => 2,
                    'your-points'       => 0,
                    'computer-points'   => 0,
                    'game-ended'        => false,
                    'your-wins'         => (session('your-wins') == null) ? 0 : session('your-wins'),
                    'computer-wins'     => (session('computer-wins') == null) ? 0 : session('computer-wins'),
                    'history'           => (session('history') == null) ? array() : session('history')
                ]);
    }
    protected function clearSessionGame21()
    {
        session([
                    'cnt-dices'         => 2,
                    'your-points'       => 0,
                    'computer-points'   => 0,
                    'game-ended'        => false,
                    'your-wins'         => 0,
                    'computer-wins'     => 0,
                    'history'           => array()
                ]);
    }
    protected function saveSettingGame21($cntDices)
    {
        session([
                    'cnt-dices' => $cntDices
                ]);
    }
    protected function setPoints($turn, $points)
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
    protected function checkYourPoints()
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
    protected function updateHistory($winner)
    {
        $history = array(
            'winner'            => $winner,
            'your-points'       => session('your-points'),
            'computer-points'   => session('computer-points')
        );
        $histories = session('history');
        if ($histories == null) {
            session(['history' => array()]);
        }
        array_push($histories, $history);
        session(['history' => $histories]);
    }
    protected function getHighScore()
    {
        $maxScore = HighScores::max('score');
        return ($maxScore == null) ? 0 : $maxScore;
    }
    protected function saveHighScore($player, $score)
    {
        $date = DateTime::createFromFormat('Y-m-d H:s:i', now());
        HighScores::insert([
                                'date'      => $date,
                                'player'    => $player,
                                'score'     => $score
                            ]);
    }
    public function index() 
    {
        $this->initSessionGame21();

        return view('game21.setting', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected'
        ]);
    }
    public function saveSetting(Request $request)
    {
        $cntDices = $request->input('cnt-dices');
        
        $this->initSessionGame21();
        $this->saveSettingGame21($cntDices);
        
        return view('game21.start', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected',
            'yourPoints'        => session('your-points'),
            'computerPoints'    => session('computer-points'),
            'yourWins'          => session('your-wins'),
            'computerWins'      => session('computer-wins')
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
            $yourWins = session('your-wins');
            session(['your-wins' => ++$yourWins]);
            if ($maxScore < session('your-points')) {
                $this->saveHighScore('You', session('your-points'));
                $highScoreMsg = 'You got high score!';
            }
        } elseif ($winner == 'Computer') {
            $message = 'You Lose!';
            $computerWins = session('computer-wins');
            session(['computer-wins' => ++$computerWins]);
            if ($maxScore < session('computer-points')) {
                $this->saveHighScore('Computer', session('computer-points'));
                $highScoreMsg = 'Computer got high score!';
            }
        } else {
            return redirect()->route('game21-view-history');
        }
        
        $this->updateHistory($winner);
        
        return view('game21.result', [
            'pageName'          => 'Game21',
            'menuGame21Class'   => 'selected',
            'yourPoints'        => session('your-points'),
            'computerPoints'    => session('computer-points'),
            'yourWins'          => session('your-wins'),
            'computerWins'      => session('computer-wins'),
            'message'           => $message,
            'highScoreMsg'      => $highScoreMsg
        ]);
    }
    public function viewHistory()
    {
        if (session('history') == null) {
            session(['history' => array()]);
        }
        return view('game21.history', [
            'pageName'          => 'Game21',
            'menuHistoryClass'  => 'selected',
            'yourWins'          => session('your-wins'),
            'computerWins'      => session('computer-wins'),
            'history'           => session('history')
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
}
