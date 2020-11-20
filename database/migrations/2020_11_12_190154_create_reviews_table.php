<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('review_title', 30)->nullable();
            $table->string('review_desc',300)->nullable(); 
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
         Schema::table('reviews', function($table){
             $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
        Schema::table('reviews', function($table){
             $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
