<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('countrie_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('name', 50);
            $table->string('pincode', 100); 
            $table->tinyInteger('active')->default(1);  
            $table->timestamps();
        });
        Schema::table('locations', function($table){
             $table->foreign('countrie_id')->references('id')->on('countries')->onDelete('cascade');
        });
           Schema::table('locations', function($table){
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade'); 
        });
            Schema::table('locations', function($table){
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
