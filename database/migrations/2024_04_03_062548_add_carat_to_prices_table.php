<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCaratToPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            if (Schema::hasColumn('prices', 'carat')) $table->dropColumn('carat');
            else $table->decimal('carat', 8, 2)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            if (Schema::hasColumn('prices', 'carat')) $table->dropColumn('carat');
        });
    }
}