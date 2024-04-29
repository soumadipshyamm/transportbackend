<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('vehicles_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->string('driver_name');
            $table->date('date');
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->integer('expense_amount');
            $table->integer('meter')->nullable();
            $table->string('purposes');
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
        Schema::dropIfExists('expenses');
    }
}
