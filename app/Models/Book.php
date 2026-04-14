<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'year', 'publisher', 'city', 'cover', 'bookshelf_id'
    ];

    protected $guarded = ['id'];

    public function bookshelf() {
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id');
    }
}
