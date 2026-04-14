<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function show($id) {
        $book = Book::with('bookshelf')->findOrFail($id);
        return view('books.show', compact('book'));
    }
}
