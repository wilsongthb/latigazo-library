<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BooksController;
use App\Models\Authors;
use App\Models\Themes;
use App\Models\Areas;

class LibraryController extends Controller
{
    public function index(){
        
        $b = new BooksController;
        $books = $b->getList();

        return view('library', [
            'req' => request()->all(),
            'books' => $books,
            'authors' => Authors::get(),
            'themes' => Themes::get(),
            'areas' => Areas::get()
        ]);
    }

    public function addAuthor($book_id){
        return view('books.addAuthor', [
            'book_id' => $book_id,
            'authors' => Authors::orderBy('nickname', 'ASC')->get()
        ]);
    }

    public function addTheme($book_id){
        return view('books.addTheme', [
            'book_id' => $book_id,
            'themes' => Themes::orderBy('name', 'ASC')->get()
        ]);
    }
    public function lookBook($book_id){
        $b = new BooksController;
        return $b->show($book_id);
    }
}
