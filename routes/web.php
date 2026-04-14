<?php

use App\Http\Controllers\BooksController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('greeting', function() {
    $user = User::first();
    return view('greeting', compact('user'));
});

Route::get('/books/{id}', [BooksController::class, 'show'])->name('books.show');