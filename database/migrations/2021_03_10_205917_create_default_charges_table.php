<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('physical_normal_charge', 8, 2)->default(0.00);
           $table->double('physical_normal_commission_cash', 8, 2)->default(0.00);
           $table->double('physical_normal_commission_online', 8, 2)->default(0.00);
           $table->double('physical_premium_charge', 8, 2)->default(0.00);
           $table->double('physical_premium_commission_cash', 8, 2)->default(0.00);
           $table->double('physical_premium_commission_online', 8, 2)->default(0.00);
           $table->double('video_normal_charge', 8, 2)->default(0.00);
           $table->double('video_normal_commission_cash', 8, 2)->default(0.00);
           $table->double('video_normal_commission_online', 8, 2)->default(0.00);
           $table->double('video_premium_charge', 8, 2)->default(0.00);
           $table->double('video_premium_commission_cash', 8, 2)->default(0.00);
           $table->double('video_premium_commission_online', 8, 2)->default(0.00);
            $table->integer('physical_normal_commission_cash_status')->default(0);
           $table->integer('physical_normal_commission_online_status')->default(0);
           
           $table->integer('physical_premium_commission_cash_status')->default(0);
           $table->integer('physical_premium_commission_online_status')->default(0);
            
           $table->integer('video_normal_commission_cash_status')->default(0);
           $table->integer('video_normal_commission_online_status')->default(0);
          
           $table->integer('video_premium_commission_cash_status')->default(0);
           $table->integer('video_premium_commission_online_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_charges');
    }
}
