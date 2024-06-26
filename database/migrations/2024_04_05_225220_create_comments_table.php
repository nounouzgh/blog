<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{  /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
       Schema::create('comments', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('resource_id');
           $table->text('text');
           $table->timestamp('date')->useCurrent();
           $table->timestamps();

           // Define foreign key constraints
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('comments');
   }
};
