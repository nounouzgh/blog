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
        Schema::create('pre_requi', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();;
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('cours_en_ligne')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_requi');
    }
};
