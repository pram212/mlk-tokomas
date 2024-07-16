<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldContentConvertionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gold_content_convertions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tag_types_id');
            $table->string('gold_content', 255);
            $table->string('result', 10);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('tag_types_id')->references('id')->on('tag_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gold_content_convertions');
    }
}
