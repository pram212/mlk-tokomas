<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('payment_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('card_number')->nullable();
            $table->double('amount', 15, 2);
            $table->timestamps();

            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_details');
    }
}
