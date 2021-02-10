<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre', 
        'book_id', 'genre_id')
        ->withTimestamps();
    }
}
