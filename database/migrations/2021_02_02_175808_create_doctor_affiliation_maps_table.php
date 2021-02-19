<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorAffiliationMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_affiliation_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('affiliation_id');
            $table->timestamps();
        });
        
        Schema::table('doctor_affiliation_maps', function($table){
            $table->foreign('affiliation_id')->references('id')->on('affiliations')->onDelete('cascade');
        });
        Schema::table('doctor_affiliation_maps', function($table){
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
        Schema::dropIfExists('doctor_affiliation_maps');
    }
}
