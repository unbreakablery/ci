<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{   
    public function index() 
    {
        $diceImgs = array();
        for ($i = 1; $i <= 6; $i++) {
            array_push($diceImgs, "<img src='images/" . $i . ".png' width='50' />");
        }
        return view('homepage', [
            'pageName'      => 'Welcome to my game',
            'menuHomeClass' => 'selected',
            'diceImgs'      => $diceImgs
        ]);
    }
}
