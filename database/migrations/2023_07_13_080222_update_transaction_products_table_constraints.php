<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('transaction_products', function (Blueprint $table) {
            $table->foreign('id_penjualan')->references('id')->on('selling_transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_produk')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('transaction_products', function (Blueprint $table) {
            $table->dropForeign('id_penjualan');
            $table->dropForeign('id_produk');
        });
    }
};
