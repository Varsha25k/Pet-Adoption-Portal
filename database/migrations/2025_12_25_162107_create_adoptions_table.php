<?php
// database/migrations/xxxx_xx_xx_create_adoptions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('pet_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->text('reason');
            $table->text('experience')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->index();

            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
