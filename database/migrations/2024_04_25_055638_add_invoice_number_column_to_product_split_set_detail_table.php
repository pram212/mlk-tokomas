<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceNumberColumnToProductSplitSetDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_split_set_detail', function (Blueprint $table) {
            if (!Schema::hasColumn('product_split_set_detail', 'invoice_number')) {
                $table->string('invoice_number', 50)->nullable();
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
            $table->dropColumn('invoice_number');
        });
    }
}
