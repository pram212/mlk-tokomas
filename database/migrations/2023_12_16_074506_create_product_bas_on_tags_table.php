<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBasOnTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_bas_on_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tag_type_id')->nullable();
            $table->unsignedBigInteger('product_property_id')->nullable();
            $table->unsignedBigInteger('gramasi_id')->nullable();
            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->double('mg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_bas_on_tags');
    }
}
