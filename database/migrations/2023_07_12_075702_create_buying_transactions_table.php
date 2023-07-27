<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buying_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_supplier');
            $table->foreignUuid('id_produk');
            $table->foreignUuid('id_brand');
            $table->integer('total_item');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buying_transactions');
    }
};
