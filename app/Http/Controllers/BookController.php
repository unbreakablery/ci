<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{   
    public function index() 
    {
        // $books = array();
        $books = Books::all();
        
        return view('books', [
            'pageName'      => 'All my books',
            'menuBooksClass' => 'selected',
            'books'      => $books
        ]);
    }
}
