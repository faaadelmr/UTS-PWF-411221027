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
        return [
            'borrow_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'return_date' => null, // Initially not returned
            'status' => 'borrowed', // Default status
        ];
    }
}
