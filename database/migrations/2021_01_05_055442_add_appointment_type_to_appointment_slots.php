<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppointmentTypeToAppointmentSlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_slots', function (Blueprint $table) {
            $table->enum('appointment_type', ['Physical', 'Video'])->default('Physical')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_slots', function (Blueprint $table) {
            $table->dropColumn('appointment_type');
        });
    }
}
