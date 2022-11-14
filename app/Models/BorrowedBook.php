<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'due',
        'borrowed_at',
        'returned_at',
    ];

    protected $casts = [
        'due' => 'date',
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
