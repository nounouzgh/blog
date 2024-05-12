<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compte_id');
            $table->unsignedBigInteger('user_id');
            $table->date('signal_date');
            $table->text('cause');
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};
