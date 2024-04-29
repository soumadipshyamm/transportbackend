<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable();
            $table->foreignId('clients_id')->nullable()->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('form_vehicle_id')->nullable()->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreignId('to_vehicle_id')->nullable()->references('id')->on('vehicles')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->date('date')->nullable();
            $table->string('img')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('reportings');
    }
}
