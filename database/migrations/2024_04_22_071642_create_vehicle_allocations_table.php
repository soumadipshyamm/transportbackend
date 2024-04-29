<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clients_id')->nullable()->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('vehicles_id')->nullable()->references('id')->on('vehicles')->onDelete('cascade');
            $table->string('allocation')->nullable();
            $table->string('working_hrs')->nullable();
            $table->string('allocation_date')->nullable();
            $table->decimal('price')->nullable();
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
        Schema::dropIfExists('vehicle_allocations');
    }
}
