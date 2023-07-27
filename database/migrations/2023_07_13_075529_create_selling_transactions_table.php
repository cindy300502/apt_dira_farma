<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('selling_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('id_user');
            $table->integer('dibayarkan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('selling_transactions');
    }
};
