<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAppointmentSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment_slots', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('appointment_slots', function (Blueprint $table) {
            $table->date('slot_date')->after('doctor_id');
            $table->dateTime('slot_date_time')->after('slot_date');
            $table->enum('status', ['Available', 'Booked'])->default('Available')->after('slot_time');
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
            //
        });
    }
}
