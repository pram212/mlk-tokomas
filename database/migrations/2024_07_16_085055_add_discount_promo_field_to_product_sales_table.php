<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountPromoFieldToProductSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sales', function (Blueprint $table) {
            $table->decimal('discount_promo', 10, 2)->nullable()->after('discount');
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
            $table->dropColumn('discount_promo');
        });
    }
}
