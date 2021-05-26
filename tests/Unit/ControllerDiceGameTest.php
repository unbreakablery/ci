<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Http\Controllers\DiceGameController;
use App\Models\History;
use App\Models\Settings;
use App\Models\HighScores;


class ControllerDiceGameTest extends TestCase
{
    /**
     * test game21 index
     */
    public function testIndex()
    {
        $response = $this->get('/game21');
        $response->assertStatus(200);
    }

    /**
     * test saveSetting
     */
    public function testSaveSetting()
    {
        $response = $this->post('/game21', [
            'cnt-dices' => 2, 
            'bet-amount' => 5
        ]);
        $response->assertStatus(200);
    }

    /**
     * test playRoll
     */
    public function testPlayRoll()
    {
        $response = $this->get('/game21/player/roll');
        $response->assertStatus(200);
    }

    /**
     * test viewHistory
     */
    public function testViewHistory()
    {
        $response = $this->get('/game21/view/history');
        $response->assertStatus(200);
    }

    /**
     * test viewHelp
     */
    public function testViewHelp()
    {
        $response = $this->get('/game21/view/help');
        $response->assertStatus(200);
    }

    /**
     * test getWinner
     */
    public function testGetWinner()
    {
        session(['your-points' => 21]);
        session(['computer-points' => 20]);

        $controller = new DiceGameController();
        $winner = $controller->getWinner();
        $this->assertEquals($winner, 'You');
    }
}
