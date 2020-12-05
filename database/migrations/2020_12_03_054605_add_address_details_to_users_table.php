<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable()->after('pic');
            $table->unsignedBigInteger('state_id')->nullable()->after('country_id');
            $table->unsignedBigInteger('city_id')->nullable()->after('state_id');
            $table->unsignedBigInteger('gender_id')->nullable()->after('city_id');
            $table->date('dob')->nullable()->after('gender_id');
            $table->string('address', 255)->nullable()->after('dob');  
            $table->string('zip', 10)->nullable()->after('address');
        });
        Schema::table('users', function($table){
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
        Schema::table('users', function($table){
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade'); 
        });
        Schema::table('users', function($table){
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); 
        });
        Schema::table('users', function($table){
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);
            $table->dropColumn(['country_id', 'state_id', 'city_id', 'gender_id', 'dob', 'address', 'zip']);
        });
    }
}
