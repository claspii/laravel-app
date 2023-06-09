<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartfood', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_food')->nullable()->index('id_food');
            $table->integer('id_cartshop')->nullable()->index('cartfood_ibfk_2');
            $table->integer('quantity')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartfood');
    }
};
