<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDoctorHolodayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_holodays', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
        });
    
        Schema::rename('doctor_holodays', 'doctor_holidays');
    
        Schema::table('doctor_holidays', function (Blueprint $table) {
            $table->enum('leave_day', ['Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday', 'Saturday', 'Sunday'])->default('Monday');
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
        Schema::dropIfExists('doctor_holidays');
    }
}
