<?php

 namespace Database\Factories;
 
 use App\Models\Book;
 use Illuminate\Database\Eloquent\Factories\Factory;
 
 /**
  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 * @method \App\Models\Book create(array $attributes = [])
  */
 class BookFactory extends Factory
 {
    protected $model = Book::class;

     /**
      * Define the model's default state.
      *
    * @return array<string, mixed>
      */
     public function definition(): array
     {
            return [
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->sentence(3, true), // Generate a short title
            'author' => fake()->name(),
            'year_published' => fake()->year(), // Year is required
            'quantity_available' => fake()->numberBetween(7, 20), // Start with a decent quantity
            'created_at' => now(),
         ];
     }
 }

