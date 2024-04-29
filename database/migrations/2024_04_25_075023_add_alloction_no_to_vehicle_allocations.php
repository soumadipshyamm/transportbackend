<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlloctionNoToVehicleAllocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_allocations', function (Blueprint $table) {
            $table->string('allocation_number')->unique()->nullable();
            $table->date('allocation_end_date')->nullable();
            $table->decimal('shift_price')->nullable();
            $table->boolean('is_active')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_allocations', function (Blueprint $table) {
            //
        });
    }
}
