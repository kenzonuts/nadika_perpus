<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('member_number')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('member_number');
            $table->index('user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
