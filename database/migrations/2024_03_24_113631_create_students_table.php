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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('specialite')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('niveau')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Add user_id column
            // Foreign key to link with users table
            $table->foreign('user_id')->references('id')->on('users');
            // Add more columns as needed for additional student attributes
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
