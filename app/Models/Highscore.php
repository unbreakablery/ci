<?php

namespace Joki20\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highscore extends Model
{
    use HasFactory;

    protected $table = 'highscores';

    // disable timestamp columns created_at and updated_at
    public $timestamps = false;
}
