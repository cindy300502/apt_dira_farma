<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
           $table->foreign('id_kategori')->references('id')->on('categories')->change()->onUpdate('cascade')->onDelete('cascade'); 
           $table->foreign('id_brand')->references('id')->on('product_brands')->change()->onUpdate('cascade')->onDelete('cascade'); 
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
            $table->dropForeign('id_kategori');
            $table->dropForeign('id_brand');
        });
    }
};
