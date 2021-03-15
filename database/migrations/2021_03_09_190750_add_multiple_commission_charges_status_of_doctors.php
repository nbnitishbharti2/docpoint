<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultipleCommissionChargesStatusOfDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('premium_charge', function (Blueprint $table) {  
           $table->integer('physical_normal_commission_cash_status')->default(0)->after('premium_patient');
           $table->integer('physical_normal_commission_online_status')->default(0)->after('premium_patient');
           
           $table->integer('physical_premium_commission_cash_status')->default(0)->after('premium_patient');
           $table->integer('physical_premium_commission_online_status')->default(0)->after('premium_patient');
            
           $table->integer('video_normal_commission_cash_status')->default(0)->after('premium_patient');
           $table->integer('video_normal_commission_online_status')->default(0)->after('premium_patient');
          
           $table->integer('video_premium_commission_cash_status')->default(0)->after('premium_patient');
           $table->integer('video_premium_commission_online_status')->default(0)->after('premium_patient');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
