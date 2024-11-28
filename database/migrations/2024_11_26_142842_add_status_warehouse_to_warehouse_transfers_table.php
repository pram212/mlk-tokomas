<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusWarehouseToWarehouseTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_transfers', function (Blueprint $table) {
            //
            $table->integer('status_warehouse')->after('warehouse_id')->default(1)->comment('1: AVAILABLE, 2: Transfer To Etalase, 3: Return To Warehouse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_transfers', function (Blueprint $table) {
            //
        });
    }
}
