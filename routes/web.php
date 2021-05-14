<?php

// classes within \Controllers
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use Joki20\Http\Controllers\Dice;
use Joki20\Http\Controllers\DiceHand;
use Joki20\Http\Controllers\Game21;
use Joki20\Http\Controllers\Yatzy;
use Joki20\Models\Books;

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

// Added for mos example code
Route::get('/hello-world', function () {
    echo "Hello World";
});
Route::get('/hello-world-view', function () {
    return view('message', [
        'message' => "Hello World from within a view"
    ]);
});
// resources/views/dice.blade.php
// after ::class is name of function within class Dice
Route::get('/', function () {
    return view('home');
});

Route::get('/info', function () {
    return view('info');
});
Route::get('/dice', function () {
    return view('dice');
});
Route::get('/game21', function () {
    return view('game21');
});
Route::post('/game21', function () {
    return view('game21');
});

Route::get('/yatzy', function () {
    return view('yatzy');
});
Route::post('/yatzy', function () {
    return view('yatzy');
});

Route::get('/books', function () {
    return view('books');
});

Route::get('/highscore', function () {
    return view('highscore');
});

Route::get('/message', function () {
    return view('message');
});

//Route::post('/game21', [Game21::class, 'game21']);

Route::get('/hello', [HelloWorldController::class, 'hello']);
Route::get('/hello/{message}', [HelloWorldController::class, 'hello']);
