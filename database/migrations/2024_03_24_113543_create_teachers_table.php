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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('specialite')->nullable();
            $table->string('grade')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Add user_id column
            // oncdition
            $table->foreign('user_id')->references('id')->on('users');
            // Add more columns as needed for additional teacher attributes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
