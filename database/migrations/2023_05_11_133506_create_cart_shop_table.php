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
        Schema::create('cart_shop', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_cart')->nullable()->index('id_cart');
            $table->integer('id_shop')->nullable()->index('id_shop');
            $table->integer('id_vouncher')->nullable()->index('id_vouncher');
            $table->integer('ship_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_shop');
    }
};
