<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('return_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('book_return_id')->constrained('book_returns')->cascadeOnDelete();
            $table->foreignUuid('borrowing_item_id')->constrained('borrowing_items')->restrictOnDelete();
            $table->string('condition')->default('good');
            $table->integer('late_days')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('book_return_id');
            $table->index('borrowing_item_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_items');
    }
};
