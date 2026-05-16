<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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
            return redirect()->route('books')->with($notification['alert-type'], $notification['message']);
        } else {
            return redirect()->route('books.create')->with('error', 'Data tidak berhasil ditambahkan');
        }

    }

    public function edit(string $id)
    {
        $data['book'] = Book::findOrFail($id);
        $data['bookshelf'] = Bookshelf::pluck('name', 'id');
        $data['category'] = Category::pluck('category', 'id');

        return view('books.edit', $data);
    }

    public function update(Request $req, string $id)
    {
        $book = Book::findOrFail($id);
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
            if($book->cover != null) {
                Storage::delete('public/cover_buku'. $req->old_cover);
            }
            $path = $req->file('cover')->storeAs(
                'cover_buku',
                'cover_buku_'.time() . '.' . $req->file('cover')->extension(),
                'public'
            );
            $val['cover'] = basename($path);
        };
        Book::where('id', $id)->update($val);

        $notification = array(
            'message' => "Data buku berhasil diubah!",
            'alert-type' => 'success'
        );

        return redirect()->route('books')->with($notification['alert-type'], $notification['message']);
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        Storage::delete('public/cover_buku'. $book->cover);

        $book->delete();

        $notification = array(
            'message' => "Data buku berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('books')->with($notification['alert-type'], $notification['message']);
    }

}

