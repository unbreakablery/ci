<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'cnt_dices',
        'dice_type',
        'coin1',
        'coin2'
    ];

    public $timestamps = false;
}
