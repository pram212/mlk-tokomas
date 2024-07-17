<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWarehouseIdNullableOnAdjustmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adjustments', function (Blueprint $table) {
            $table->unsignedInteger('warehouse_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adjustments', function (Blueprint $table) {
            $table->unsignedInteger('warehouse_id')->change();
        });
    }
}
