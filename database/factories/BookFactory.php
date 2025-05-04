<?php

 namespace Database\Factories;
 
 use App\Models\Book;
 use Illuminate\Database\Eloquent\Factories\Factory;
 
 class BookFactory extends Factory
 {
    protected $model = Book::class;

     public function definition(): array
     {
            return [
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->sentence(3, true), // membuat kalimat dengan 3 kata
            'author' => fake()->name(),
            'year_published' => fake()->year(),
            'quantity_available' => fake()->numberBetween(7, 20), // jummlah buku yang dibuat dari 7 - 20 buku
            'created_at' => now(),
         ];
     }
 }

