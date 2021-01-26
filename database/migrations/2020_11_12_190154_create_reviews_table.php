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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('wating_rate')->default('1');
            $table->integer('rate')->default('1');
            $table->text('review_desc')->nullable(); 
            $table->enum('status', ['New', 'Approved', 'Rejected'])->default('New');
            $table->timestamps();
        });
        Schema::table('reviews', function($table){
             $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
        Schema::table('reviews', function($table){
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
