<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_properties_id');
            $table->decimal('discount', 8, 2);
            $table->dateTime('start_period');
            $table->dateTime('end_period');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('product_properties_id')->references('id')->on('product_properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promos');
    }
}
