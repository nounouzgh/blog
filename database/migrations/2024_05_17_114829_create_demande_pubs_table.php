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
    Schema::create('demande_pubs', function (Blueprint $table) {
        $table->id();
        $table->string('nom')->nullable();
        $table->string('tel')->nullable();
        $table->string('email')->nullable();
        $table->text('description')->nullable();
        $table->string('specialite')->nullable();
        $table->boolean('accepted')->default(false);

        $table->unsignedBigInteger('ads_id')->nullable();
        $table->foreign('ads_id')->references('id')->on('ads');

        
       
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */

        public function down(): void
    {
        Schema::table('demande_pubs', function (Blueprint $table) {
            // Drop the foreign key constraint first
        
            $table->dropForeign(['ads_id']);
        });
        Schema::dropIfExists('demande_pubs');
    }
    
};
