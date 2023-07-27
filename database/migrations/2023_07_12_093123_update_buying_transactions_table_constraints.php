<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('buying_transactions', function (Blueprint $table) {
            $table->foreign('id_supplier')->references('id')->on('supplier')->change()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_produk')->references('id')->on('products')->change()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_brand')->references('id')->on('product_brands')->change()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('buying_transactions', function (Blueprint $table) {
            $table->dropForeign('id_supplier');
            $table->dropForeign('id_produk');
            $table->dropForeign('id_brand');
        });
    }
};
