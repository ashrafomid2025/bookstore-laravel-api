<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn');
            $table->text('description')->nullable();
            $table->date('published_at');
            $table->integer('total_copies')->default(1);
            $table->integer('avaiable_copies')->default(1);
            $table->string('cover_image');
            $table->enum('status', ['available','unavailable'])->default('available');
            $table->decimal('price',4,2);
            $table->foreignId('author_id')->constrained('authors')->cascadeOnDelete();
            $table->string('genre');
            $table->timestamps();

            $table->index(['title','author_id']);
            $table->index(['isbn']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
