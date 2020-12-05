<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('doctor_id',50)->nullable();
            $table->string('actual_doctor_id',50);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('speciality_id');
            $table->unsignedBigInteger('gender_id');
            $table->string('name', 50)->nullable();
            $table->longText('about')->nullable();
            $table->date('dob')->nullable();
            $table->string('pic',200)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('alt_moblie', 50)->nullable(); 
            $table->string('fax', 50)->nullable();
            $table->string('email', 50)->nullable(); 
            $table->string('address', 255)->nullable();  
            $table->string('zip', 10)->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->string('website', 255)->nullable(); 
            $table->enum('status',['Active', 'Inactive'])->default('Active'); 
            $table->timestamps();
        });
        Schema::table('doctors', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('doctors', function($table){
             $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
           Schema::table('doctors', function($table){
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade'); 
        });
        Schema::table('doctors', function($table){
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); 
        });
        Schema::table('doctors', function($table){
            $table->foreign('speciality_id')->references('id')->on('specialities')->onDelete('cascade'); 
        });
        Schema::table('doctors', function($table){
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade'); 
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
