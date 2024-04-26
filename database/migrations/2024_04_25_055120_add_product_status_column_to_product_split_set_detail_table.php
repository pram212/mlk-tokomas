<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductStatusColumnToProductSplitSetDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_split_set_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('product_split_set_detail', 'product_status')) {
                $table->boolean('product_status')->default(1)->comment('0 = SOLD, 1 = STORE');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_split_set_detail', function (Blueprint $table) {
            $table->dropColumn('product_status');
        });
    }
}
