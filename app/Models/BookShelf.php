<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookShelf extends Model
{
    protected $table = 'bookshelves';
    protected $guarded = ['id'];

    public function book() {
        return $this->hasMany(Book::class, 'bookshelf_id');
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id');
    }
}
