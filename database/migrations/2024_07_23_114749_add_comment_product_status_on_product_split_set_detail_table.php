<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentProductStatusOnProductSplitSetDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_split_set_detail', function (Blueprint $table) {
            $table->integer('product_status')->length(1)->default(1)->comment('0 = SOLD, 1 = STORE, 2 = Transfer to Gudang')->change();
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
            $table->boolean('product_status')->default(1)->comment('0 = SOLD, 1 = STORE')->change();
        });
    }
}