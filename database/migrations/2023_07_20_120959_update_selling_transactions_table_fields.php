<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('selling_transactions', function (Blueprint $table) {
            $table->integer('sub_total');
            $table->integer('diskon');
        });
    }
    
    
    public function down()
    {
        Schema::table('selling_transactions', function (Blueprint $table) {
            $table->dropColumn('sub_total');
            $table->dropColumn('diskon');
        });
    }
};
