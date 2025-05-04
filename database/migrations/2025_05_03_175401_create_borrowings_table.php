<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->increments('borrowing_id');
            $table->integer('member_id')->unsigned();
            $table->integer('book_id')->unsigned();
            $table->date('borrow_date')->useCurrent();
            $table->date('return_date');
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed'); 
            $table->foreign('member_id')->references('member_id')->on('users');
            $table->foreign('book_id')->references('book_id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
