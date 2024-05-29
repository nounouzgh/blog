<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();;
            $table->string('specialite')->nullable();;
            $table->date('date')->nullable();;
            $table->unsignedBigInteger('id_owner');
            // Corrected foreign key definition
            $table->foreign('id_owner')->references('id')->on('owners');
            $table->string('dien')->nullable();
 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
    
        Schema::table('demande_pubs', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['user_id']);
       
        });
        Schema::dropIfExists('ads');
   
    }
};
