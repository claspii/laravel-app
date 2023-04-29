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
            $table->integer('id_shop')->nullable()->index('id_shop');
            $table->integer('id_cart')->nullable()->index('id_cart');
            $table->integer('id_vouncher')->nullable();
            $table->integer('id_food')->nullable()->index('id_food');
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
