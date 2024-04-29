<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSubLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_sub_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clients_id')->nullable()->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('client_locations_id')->nullable()->references('id')->on('client_locations')->onDelete('cascade');
            $table->string('sub_location')->nullable();
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
        Schema::dropIfExists('client_sub_locations');
    }
}
