<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableAttrToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('barcode_symbology')->nullable()->change();
            $table->integer('category_id')->nullable()->change();
            $table->integer('unit_id')->nullable()->change();
            $table->integer('purchase_unit_id')->nullable()->change();
            $table->integer('sale_unit_id')->nullable()->change();
            $table->string('cost')->nullable()->change();
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
            $table->string('name')->change();
            $table->string('type')->change();
            $table->string('barcode_symbology')->change();
            $table->integer('category_id')->change();
            $table->integer('unit_id')->change();
            $table->integer('purchase_unit_id')->change();
            $table->integer('sale_unit_id')->change();
            $table->string('cost')->change();
        });
    }
}
