<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            if (!Schema::hasColumn('prices', 'carat')) {
                $table->decimal('carat', 10, 2)->nullable()->after('price');
            }

            if (!Schema::hasColumn('prices', 'categories_id')) {
                $table->unsignedBigInteger('categories_id')->nullable()->after('gramasi_id');
            }

            if (!Schema::hasColumn('prices', 'tag_type_id')) {
                $table->unsignedBigInteger('tag_type_id')->nullable()->after('categories_id');
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
        Schema::table('prices', function (Blueprint $table) {
            //
        });
    }
}
