<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'book_id';

    
    public $timestamps = false;

    protected $fillable = [
        'isbn',
        'title',
        'author',
        'year_published',
        'quantity_available',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'book_id', 'book_id');
    }
}
