<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriesidToGramasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gramasis', function (Blueprint $table) {
            if (Schema::hasColumn('gramasis', 'categories_id')) $table->dropColumn('categories_id');
            $table->unsignedInteger('categories_id')->after('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gramasis', function (Blueprint $table) {
            if (Schema::hasColumn('gramasis', 'categories_id')) $table->dropColumn('categories_id');
        });
    }
}
