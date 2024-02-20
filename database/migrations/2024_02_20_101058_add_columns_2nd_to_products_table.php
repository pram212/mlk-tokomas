<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns2ndToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string("treat_recomendation")->nullable();
            $table->string("done_time", 35)->nullable();
            $table->string("processing_time", 45)->nullable();
            $table->string("treat_interval", 35)->nullable();
            $table->string("treat_step")->nullable();
            $table->string("recomendation_after")->nullable();
            $table->string("description")->nullable();
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
            $table->dropColumn(['treat_recomendation', 'done_time', 'processing_time', 'treat_interval', 'treat_step', 'recomendation_after', 'description']);
        });
    }
}
