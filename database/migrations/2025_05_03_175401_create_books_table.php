<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('book_id');
            $table->string('isbn', 20)->unique();
            $table->string('title', 150);
            $table->string('author', 100)->nullable();
            $table->year('year_published')->nullable();
            $table->integer('quantity_available')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
