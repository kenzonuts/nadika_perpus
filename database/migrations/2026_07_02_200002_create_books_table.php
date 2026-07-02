<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('category_id')->constrained('categories')->restrictOnDelete();
            $table->foreignUuid('shelf_id')->constrained('shelves')->restrictOnDelete();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('isbn')->unique();
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->smallInteger('publication_year')->nullable();
            $table->string('language')->default('English');
            $table->integer('pages')->nullable();
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('available_stock')->default(0);
            $table->string('publication_status')->default('draft');
            $table->integer('borrow_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('title');
            $table->index('isbn');
            $table->index('author');
            $table->index('category_id');
            $table->index('shelf_id');
            $table->index('publication_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
