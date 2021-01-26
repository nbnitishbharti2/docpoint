<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentSlotsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_slots_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time', 0);
            $table->time('end_time', 0);
            $table->unsignedBigInteger('interval');
            $table->text('days');
            $table->enum('appointment_type', ['Physical', 'Video'])->default('Physical');
            $table->timestamps();
        });
        Schema::table('appointment_slots_data', function($table){
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
        Schema::dropIfExists('appointment_slots_data');
    }
}
