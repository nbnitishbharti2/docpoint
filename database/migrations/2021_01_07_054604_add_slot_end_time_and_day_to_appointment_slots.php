<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlotEndTimeAndDayToAppointmentSlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_slots', function (Blueprint $table) {
            $table->time('slot_end_time', 0)->after('slot_time');
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
            $table->dropColumn('slot_end_time');
        });
    }
}
