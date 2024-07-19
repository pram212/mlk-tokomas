<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_split_set_detail', function (Blueprint $table) {
            // Menambahkan indeks pada kolom split_set_code
            $table->index('split_set_code');
        });

        Schema::create('warehouse_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transfer_number', 100)->unique();
            $table->unsignedInteger('product_id');
            $table->string('split_set_code', 50)->nullable();
            $table->unsignedInteger('warehouse_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('split_set_code')->references('split_set_code')->on('product_split_set_detail')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_transfers');

        Schema::table('product_split_set_detail', function (Blueprint $table) {
            // Menghapus indeks pada kolom split_set_code
            $table->dropIndex(['split_set_code']);
        });
    }
}
