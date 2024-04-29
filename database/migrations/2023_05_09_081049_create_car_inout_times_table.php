<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarInoutTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_inout_times', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->date('car_date');
            $table->foreignId('vehicles_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreignId('clients_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('in_time')->nullable();
            $table->timestamp('out_time')->nullable();
            $table->string('in_time_img')->nullable();
            $table->string('out_time_img')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_inout_times');
    }
}
