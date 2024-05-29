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
        Schema::create('reunions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date');
            $table->integer('duree');
            $table->string('specialite');
            $table->unsignedBigInteger('iduser_etd')->nullable();
            $table->foreign('iduser_etd')->references('id')->on('students');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reunions');
    }
};
