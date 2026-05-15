<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'year',
        'publisher',
        'city',
        'category_id',
        'bookshelf_id',
        'cover'
    ];

    public function bookshelf() {
        return $this->belongsTo(Bookshelf::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function loadDetails() {
        return $this->hasMany(LoanDetail::class);
    }

}
