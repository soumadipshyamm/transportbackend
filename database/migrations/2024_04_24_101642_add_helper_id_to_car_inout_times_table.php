<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHelperIdToCarInoutTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_inout_times', function (Blueprint $table) {
            $table->foreignId('helper_id')->nullable()->references('id')->on('helpers')->onDelete('cascade');
            $table->time('total_hours')->nullable();
            $table->bigInteger('hours_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_inout_times', function (Blueprint $table) {
            //
        });
    }
}
