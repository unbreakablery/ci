<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighScores extends Model
{
    use HasFactory;

    protected $table = 'highscores';

    protected $fillable = [
        'date',
        'player',
        'score'
    ];

    public $timestamps = false;
}
