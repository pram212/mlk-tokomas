<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceNumberToProductBuybackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_buyback', function (Blueprint $table) {
            if (!Schema::hasColumn('product_buyback', 'invoice_number')) {
                // based on table sale.reference_no
                $table->string('invoice_number', 191)->after('id');

                $table->index('invoice_number');

                $table->foreign('invoice_number')->references('reference_no')->on('sales')->onDelete('cascade');
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
        Schema::table('product_buyback', function (Blueprint $table) {
            $table->dropForeign(['invoice_number']);
            $table->dropIndex(['invoice_number']);
            $table->dropColumn('invoice_number');
        });
    }
}
