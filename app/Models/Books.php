<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'isbn',
        'title',
        'author',
        'image_url'
    ];

    public $timestamps = false;
}
