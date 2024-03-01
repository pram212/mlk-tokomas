<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_type_id')->nullable();
            $table->unsignedBigInteger('product_property_id')->nullable();
            $table->unsignedBigInteger('gramasi_id')->nullable();
            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->double('mg')->default(0);
            $table->double('discount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('tag_type_id');
            $table->dropColumn('product_property_id');
            $table->dropColumn('gramasi_id');
            $table->dropColumn('product_type_id');
            $table->dropColumn('mg');
            $table->dropColumn('discount');
        });

    }
}
