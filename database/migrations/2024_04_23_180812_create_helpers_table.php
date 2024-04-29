<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('email');
            $table->integer('phone');
            $table->string('address');
            $table->bigInteger('salary')->nullable();
            $table->bigInteger('incentive')->nullable();
            $table->string('details')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('ifc_code')->nullable();
            $table->bigInteger('ac_no')->nullable();
            $table->string('holder_name')->nullable();
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
        Schema::dropIfExists('helpers');
    }
}
