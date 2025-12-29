<?php
// database/migrations/xxxx_create_pets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['dog', 'cat', 'bird', 'rabbit', 'other']);
            $table->string('breed');
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->enum('size', ['small', 'medium', 'large']);
            $table->text('description');
            $table->string('location');
            $table->string('image')->nullable();
            $table->boolean('vaccinated')->default(false);
            $table->boolean('trained')->default(false);
            $table->enum('status', ['available', 'adopted'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};