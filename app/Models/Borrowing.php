<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;


class Borrowing extends Model
{
    use HasFactory;

    protected $primaryKey = 'borrowing_id';

    public $timestamps = false;


    protected $fillable = [
        'member_id',
        'book_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'member_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
