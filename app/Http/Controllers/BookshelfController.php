<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookshelf;

class BookshelfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['bookshelves'] = Bookshelf::get();
        return view('bookshelves.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookshelves.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'code' => 'required|max:10',
            'name' => 'required'
        ]);
        Bookshelf::create($val);
        return redirect('bookshelves')->with('success', 'Data rak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['bookshelf'] = Bookshelf::findOrFail($id);
        return view('bookshelves.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Bookshelf::findOrFail($id);
        $val = $request->validate([
            'code' => 'required|max:10',
            'name' => 'required'
        ]);
        Bookshelf::where('id', $id)->update($val);
        return redirect('bookshelves')->with('success', 'Data rak berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bs = Bookshelf::findOrFail($id);
        $bs->delete();
        return redirect('bookshelves')->with('success', 'Data rak berhasil dihapus');
    }
}
