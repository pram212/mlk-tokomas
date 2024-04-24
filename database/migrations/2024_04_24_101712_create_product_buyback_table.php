<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBuybackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_buyback', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('product_id');
                $table->string('code', 50);
                // harga awal
                $table->decimal('price', 15, 2);
                // potongan
                $table->decimal('discount', 15, 2);
                // biaya tambahan
                $table->decimal('additional_cost', 15, 2);
                // harga akhir
                $table->decimal('final_price', 15, 2);
                // keterangan
                $table->string('description',100);
                // product_property_id
                $table->unsignedBigInteger('product_property_id');

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
        Schema::dropIfExists('product_buyback');
    }
}
