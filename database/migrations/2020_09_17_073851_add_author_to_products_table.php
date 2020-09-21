<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('author')->after('product_name');
            $table->string('publisher')->after('author');
            $table->string('page')->after('description');
            $table->string('language')->after('page');
            $table->string('cover')->after('language');
            $table->float('weight')->after('cover');
            $table->float('long')->after('weight');
            $table->float('wide')->after('long');
            $table->float('discount')->after('price')->nullable();

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
            // $table->dropColumn('author');
            // $table->dropColumn('publisher');
            $table->dropColumn('page');
            $table->dropColumn('language');
            $table->dropColumn('cover');
            $table->dropColumn('weight');
            $table->dropColumn('long');
            $table->dropColumn('wide');
        });
    }
}
