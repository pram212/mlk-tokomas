<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditCardColumnOnPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_with_credit_card', function (Blueprint $table) {
            // ubah kolom charge_id jadi nullable
            $table->string('charge_id')->nullable()->change();
            // tambahkan kolom credit_card_id yang bereferensi ke tabel credit_cards
            $table->unsignedBigInteger('credit_card_id');

            $table->foreign('credit_card_id')->references('id')->on('credit_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_with_credit_card', function (Blueprint $table) {
            $table->dropForeign(['credit_card_id']);
            $table->dropColumn('credit_card_id');
        });
    }
}
