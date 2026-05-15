<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $data['books'] = Book::with(['bookshelf', 'category'])->get();
        return view('books.index')->with($data);
    }

    public function create()
    {
        $data['bookshelves'] = Bookshelf::pluck('name', 'id');
        $data['category'] = Category::pluck('category', 'id');
        return view('books.create', $data);
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $val = $req->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1990|max:'.(date('Y')),
            'publisher' => 'required|max:150',
            'city' => 'required|max:100',
            'category_id' => 'required|integer',
            'bookshelf_id' => 'required|integer',
            'cover' => 'nullable|image'
        ]);
        if($req->hasFile('cover')) {
            $path = $req->file('cover')->storeAs(
                'cover_buku',
                'cover_buku_'.time() . '.' . $req->file('cover')->extension(),
                'public'
            );
            $val['cover'] = basename($path);
        }
        Book::create($val);

        $notification = array(
            'message' => "Data buku berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        if($req->save) {
            return redirect()->route('books')->with($notification);
        } else {
            return redirect()->route('books.create')->with($notification);
        }

    }

}
