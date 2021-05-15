<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DiceGameController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomepageController::class, 'index'], function () {
})->name('landing-page');
Route::get('game21', [DiceGameController::class, 'index'], function () {
})->name('game21');
Route::post('game21', [DiceGameController::class, 'saveSetting'], function () {
})->name('game21-save-setting');
Route::get('game21/player/roll', [DiceGameController::class, 'playRoll'], function () {
})->name('game21-player-roll');
Route::get('game21/computer/play', [DiceGameController::class, 'playComputer'], function () {
})->name('game21-computer-play');
Route::get('game21/view/result', [DiceGameController::class, 'viewResult'], function () {
})->name('game21-view-result');
Route::get('game21/view/history', [DiceGameController::class, 'viewHistory'], function () {
})->name('game21-view-history');
Route::get('game21/clear/history', [DiceGameController::class, 'clearHistory'], function () {
})->name('game21-clear-history');
Route::get('game21/view/highscores', [DiceGameController::class, 'viewHighScores'], function () {
})->name('game21-view-highscores');
Route::get('game21/clear/highscores', [DiceGameController::class, 'clearHighScores'], function () {
})->name('game21-clear-highscores');
Route::get('books', [BookController::class, 'index'], function () {
})->name('books');
