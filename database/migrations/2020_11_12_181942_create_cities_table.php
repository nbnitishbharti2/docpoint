<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->string('alias', 100); 
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
         Schema::table('cities', function($table){
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
           Schema::table('cities', function($table){
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
