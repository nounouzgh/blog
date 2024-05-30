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
        Schema::create('help_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser_enseignant');
            $table->foreign('iduser_enseignant')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('iduser_etudiant');
            $table->foreign('iduser_etudiant')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('idressource');
            $table->foreign('idressource')->references('id')->on('resources')->onDelete('cascade');
            $table->date('date');
            $table->text('contenu');
            $table->text('reponse')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_requests');
    }
};
