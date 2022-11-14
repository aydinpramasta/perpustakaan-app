<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'writer',
        'description',
        'cover',
    ];

    public function borrows()
    {
        return $this->hasMany(BorrowedBook::class, 'book_id');
    }
}
