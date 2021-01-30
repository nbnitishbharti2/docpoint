<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSpacilityMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_spacility_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('speciality_id');
            $table->unsignedBigInteger('doctor_id');
            $table->timestamps();
        });
        Schema::table('doctor_spacility_maps', function($table){
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('cascade');
        });
        Schema::table('doctor_spacility_maps', function($table){
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_spacility_maps');
    }
}
