<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductStatusAndInvoiceNumberToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambahkan kolom product_status dengan tipe data boolean
            $table->boolean('product_status')->default(1)->comment('0 = SOLD, 1 = STORE');

            // Tambahkan kolom invoice_number dengan tipe data string (varchar) dengan panjang maksimal 50 karakter
            $table->string('invoice_number', 50)->nullable();
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
            // Rollback jika migrasi dijalankan ulang
            $table->dropColumn('product_status');
            $table->dropColumn('invoice_number');
        });
    }
}
