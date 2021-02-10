<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    //Tables that has column with that "name"
    protected $fillable = [
        'name',
    ];

    //Will find the relationship
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_author', 
        'book_id', 'author_id')
        ->withTimestamps();
    }
}
