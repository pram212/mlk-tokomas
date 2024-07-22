<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInvoiceSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('invoice_settings')) {
            Schema::create('invoice_settings', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('warehouse_id')->nullable();
                $table->string('invoice_prefix')->nullable();
                $table->string('invoice_logo')->nullable();
                $table->string('invoice_logo_text')->nullable();
                $table->string('invoice_logo_watermark')->nullable();
                $table->timestamps();

                $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_settings', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropIfExists();
        });
    }
}
