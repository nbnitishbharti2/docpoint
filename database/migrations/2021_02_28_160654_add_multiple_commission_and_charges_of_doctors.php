<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultipleCommissionAndChargesOfDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('premium_charge', function (Blueprint $table) {
           // $table->dropColumn('amount');
           $table->double('physical_normal_charge', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('physical_normal_commission_cash', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('physical_normal_commission_online', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('physical_premium_charge', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('physical_premium_commission_cash', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('physical_premium_commission_online', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('video_normal_charge', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('video_normal_commission_cash', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('video_normal_commission_online', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('video_premium_charge', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('video_premium_commission_cash', 8, 2)->default(0.00)->after('premium_patient');
           $table->double('video_premium_commission_online', 8, 2)->default(0.00)->after('premium_patient');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('premium_charge', function($table) {
        //      $table->integer('comment_count');
        //      $table->integer('view_count');
        //   });
        // Schema::table('premium_charge', function (Blueprint $table) {
        //     $table->dropColumn('amount');
        // });
       
    }
}
