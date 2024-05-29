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
        Schema::create('evenement_payent', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('date');
            $table->integer('duree'); // assuming duree is in minutes
            $table->decimal('prix', 8, 2); // assuming prix is a decimal value
            $table->string('specialite');
            $table->integer('nbr_de_place');
            $table->unsignedBigInteger('expere_id')->nullable(); // Make expert_id nullable
            $table->foreign('expere_id')->references('id')->on('experts')->onDelete('cascade');
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenement_payent');
    }
};

