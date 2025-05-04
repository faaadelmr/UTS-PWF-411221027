<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 * @method \App\Models\Borrowing create(array $attributes = [])
 */
class BorrowingFactory extends Factory
{
    protected $model = Borrowing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Note: member_id and book_id should be provided when creating
        $borrowDate = fake()->dateTimeBetween('-1 month', 'now');
        return [
            'borrow_date' => $borrowDate,
            'return_date' => fake()->dateTimeBetween($borrowDate, date('Y-m-d', strtotime('+2 weeks', $borrowDate->getTimestamp()))),
            'status' => 'borrowed', // Default status
        ];
    }
}
