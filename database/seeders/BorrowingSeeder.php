<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Seeder;


class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = User::where('role', 'member')->get();
        $bookIds = Book::where('quantity_available', '>', 0)->pluck('book_id');

        if ($bookIds->isEmpty()) {
            $this->command->warn('No available books to borrow. Skipping BorrowingSeeder.');
            return; // Exit if no books are available
        }

        $borrowingsCreated = 0; // Initialize counter for created borrowings

        foreach ($members as $member) {
            $numberOfBooksToBorrow = rand(3, 5);
            // Get available book IDs again inside the loop in case quantities change
            $currentAvailableBookIds = Book::where('quantity_available', '>', 0)->pluck('book_id');

            // Ensure we don't try to borrow more books than available
            $numberOfBooksToBorrow = min($numberOfBooksToBorrow, $currentAvailableBookIds->count());

            // Select unique random book IDs from the available ones
            $selectedBookIds = $currentAvailableBookIds->random($numberOfBooksToBorrow)->unique();

            foreach ($selectedBookIds as $bookId) {
                Borrowing::factory()->create([
                    'member_id' => $member->member_id,
                    'book_id' => $bookId,
                ]);
                // Decrement book quantity
                Book::where('book_id', $bookId)->decrement('quantity_available');
                $borrowingsCreated++;
            }
        }

        $this->command->info("Borrowing seeding completed: {$borrowingsCreated} borrowing records created.");
    }
}