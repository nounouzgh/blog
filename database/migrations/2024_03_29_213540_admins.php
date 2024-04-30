<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->unsignedBigInteger('compte_id'); // Foreign key referencing the 'comptes' table
            $table->timestamps();
            // Foreign key constraints
            $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade');
     });

    }



    
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
