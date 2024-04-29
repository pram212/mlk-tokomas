<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDescriptionNullTableProductBuyback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_buyback', function (Blueprint $table) {
            // Hapus kolom yang sudah ada
            $table->dropColumn('description');
        });

        Schema::table('product_buyback', function (Blueprint $table) {
            // Tambahkan kembali kolom dengan atribut yang diinginkan
            $table->string('description', 100)->nullable()->after('final_price');
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
            
        });
    }
}
