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
        Schema::create('cours_en_ligne', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->time('duree')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->string('specialite')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable(); // Make teacher_id nullable

            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_en_ligne');
    }
};
