<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceGramasiMgToProductSplitSetDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_split_set_detail', function (Blueprint $table) {
            // Tambahkan 3 kolom baru setelah invoice_number
            $table->decimal('price', 15, 2)->nullable()->after('invoice_number');
            $table->decimal('gramasi', 15, 2)->nullable()->after('price');
            $table->decimal('mg', 15, 2)->nullable()->after('gramasi');
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
            $table->dropColumn('price');
            $table->dropColumn('gramasi');
            $table->dropColumn('mg');
        });
    }
}
