<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function ratings()
    {
        return $this->hasMany(Rating::class);
        $book = Book::with('ratings')->find($id);
        $average = $book->ratings->avg('stars');
    }
}


