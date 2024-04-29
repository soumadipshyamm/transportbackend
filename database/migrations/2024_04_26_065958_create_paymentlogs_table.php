<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentlogs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('payment_number')->unique()->nullable();
            $table->date('date');
            $table->foreignId('payment_details_id')->nullable()->references('id')->on('payment_details')->onDelete('cascade');
            $table->foreignId('vehicles_id')->nullable()->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreignId('clients_id')->nullable()->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('vehicle_allocations_id')->nullable()->references('id')->on('vehicle_allocations')->onDelete('cascade');
            $table->foreignId('expenses_id')->nullable()->references('id')->on('expenses')->onDelete('cascade');
            $table->string('total_price')->nullable();
            $table->string('advance_payment')->nullable();
            $table->string('due_payment')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('users_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('paymentlogs');
    }
}
