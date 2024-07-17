<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProductIdFromProductWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_warehouse', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_warehouse', function (Blueprint $table) {
            $table->UnsignedInteger('product_id');
        });
    }
}
