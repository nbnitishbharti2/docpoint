<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomefieldsInAppoinment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
             $table->enum('booking_type', ['Normal', 'Premium'])->default('Normal')->after('patient_type');
             $table->enum('payment_status', ['pending', 'Done'])->default('pending')->after('patient_type');
             $table->enum('payment_mode', ['NotDone','Cash', 'Online'])->default('NotDone')->after('patient_type');
             $table->double('total', 8, 2)->default(0.00)->after('patient_type');
             $table->double('doctor_com', 8, 2)->default(0.00)->after('patient_type');
             $table->double('doctor_due', 8, 2)->default(0.00)->after('patient_type');
             $table->double('admin_com', 8, 2)->default(0.00)->after('patient_type');
             $table->double('admin_due', 8, 2)->default(0.00)->after('patient_type');
             $table->enum('sattelment_status', [0, 1])->default(0)->after('patient_type');
             $table->date('sattelment_date')->after('patient_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appoinment', function (Blueprint $table) {
            //
        });
    }
}
