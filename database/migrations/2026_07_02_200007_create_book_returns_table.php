<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_returns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('borrowing_id')->constrained('borrowings')->restrictOnDelete();
            $table->date('returned_date');
            $table->text('notes')->nullable();
            $table->foreignUuid('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('borrowing_id');
            $table->index('returned_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_returns');
    }
};
