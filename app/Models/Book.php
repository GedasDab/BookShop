<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','title', 'cover', 'description',
    ];


    public function authors(){
        return $this->belongstoMany(Author::class, 'book_author', 
        'book_id', 'author_id')
        ->withTimestamps();
    }

    public function created_at_difference(){
           return Carbon::createFromTimestamp(strtotime($this->created_at))->diff(Carbon::now())->days;
      } 
}
