<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionAndProductToDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id')->nullable()->after('id');
            $table->unsignedBigInteger('product_id')->nullable()->after('transaction_id');

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('product_id')->references('product_id')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['product_id']);
            $table->dropColumn('transaction_id');
            $table->dropColumn('product_id');
        });
    }
}
