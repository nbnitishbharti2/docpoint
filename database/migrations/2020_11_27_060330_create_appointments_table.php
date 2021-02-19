<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('appointment_slot_id')->nullable();
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->enum('patient_type', ['New', 'Existing'])->default('New'); 
            $table->enum('appointment_type', ['In-Person', 'Video'])->default('In-Person');
            $table->date('appointment_date');
            $table->enum('status', ['Active', 'Approved', 'Canceled', 'Rejected'])->default('Active');
            $table->dateTime('canceled_at')->nullable();
            $table->dateTime('rejected_at')->nullable();  
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('appointments', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('appointments', function($table){
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
        Schema::table('appointments', function($table){
            $table->foreign('appointment_slot_id')->references('id')->on('appointment_slots')->onDelete('cascade');
        });
        Schema::table('appointments', function($table){
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
