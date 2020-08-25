<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('transaction_id')->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');

            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['transaction_id']);
            $table->dropColumn('product_id');
            $table->dropColumn('transaction_id');
        });

        Schema::dropIfExists('images');
    }
}
