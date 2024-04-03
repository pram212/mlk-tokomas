<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesProductPropertyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices_product_property_detail', function (Blueprint $table) {
            Schema::dropIfExists('prices_product_property_detail');
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('price_id')->unsigned();
            $table->unsignedBigInteger('product_property_id')->unsigned();
            $table->double('price')->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices');
            $table->foreign('product_property_id')->references('id')->on('product_properties');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices_product_property_detail', function (Blueprint $table) {
            $table->dropForeign(['price_id']);
            $table->dropForeign(['product_property_id']);
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('prices_product_property_detail');
    }

}
