<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDefaultValueForSaleUnitIdOnProductSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sales', function (Blueprint $table) {
            $table->unsignedInteger('sale_unit_id')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sales', function (Blueprint $table) {
            $table->unsignedInteger('sale_unit_id')->default(null)->change();
        });
    }
}
