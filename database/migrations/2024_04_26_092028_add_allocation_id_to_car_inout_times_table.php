<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllocationIdToCarInoutTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_inout_times', function (Blueprint $table) {
            $table->foreignId('vehicle_allocations_id')->nullable()->references('id')->on('vehicle_allocations')->onDelete('cascade');
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
