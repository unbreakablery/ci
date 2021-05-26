<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    protected $fillable = [
        'date',
        'winner',
        'point1',
        'point2',
        'bet_amount'
    ];

    public $timestamps = false;
}
