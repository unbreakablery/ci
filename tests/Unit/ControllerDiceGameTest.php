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

    /**
     * test initSessionGame21
     */
    public function testInitSessionGame21()
    {
        $controller = new DiceGameController();
        $controller->initSessionGame21();
        $this->assertEquals(session('cnt-dices'), 2);
    }

    /**
     * test saveSettingGame21
     */
    public function testSaveSettingGame21()
    {
        $controller = new DiceGameController();
        $controller->saveSettingGame21(2, 5);
        $this->assertEquals(session('bet-amount'), 5);
    }
}
