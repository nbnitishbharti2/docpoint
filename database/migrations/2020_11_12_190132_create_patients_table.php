<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('name', 30)->nullable();
            $table->string('pic',200)->nullable();
            $table->string('complete_address', 150)->nullable();
            $table->string('contact_no', 15)->nullable(); 
            $table->string('aletenate_contact', 20);
            $table->string('email', 50)->nullable(); 
            $table->date('dob')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::table('patients', function($table){
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('patients', function($table){
             $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
