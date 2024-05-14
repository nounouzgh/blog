<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();;
            $table->string('email')->nullable();;
            $table->string('specialite')->nullable();;
            $table->unsignedBigInteger('expert_id')->nullable();; // Assuming this is the foreign key for the expert relationship
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');
            // Add other foreign key constraints as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_inscriptions');
    }
}
