<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowingFactory extends Factory
{
    protected $model = Borrowing::class;

    public function definition(): array
    {
        $borrowDate = fake()->dateTimeBetween('-1 month', 'now');
        return [
            'borrow_date' => $borrowDate,
            'return_date' => fake()->dateTimeBetween($borrowDate, date('Y-m-d', strtotime('+2 weeks', $borrowDate->getTimestamp()))),
            'status' => 'borrowed', // Default status
        ];
    }
}
