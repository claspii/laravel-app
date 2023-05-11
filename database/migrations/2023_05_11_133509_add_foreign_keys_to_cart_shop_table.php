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
        Schema::table('cart_shop', function (Blueprint $table) {
            $table->foreign(['id_shop'], 'cart_shop_ibfk_1')->references(['id'])->on('account')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_vouncher'], 'cart_shop_ibfk_2')->references(['id'])->on('vouncher')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_cart'], 'cart_shop_ibfk_3')->references(['id'])->on('cart')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_shop', function (Blueprint $table) {
            $table->dropForeign('cart_shop_ibfk_1');
            $table->dropForeign('cart_shop_ibfk_2');
            $table->dropForeign('cart_shop_ibfk_3');
        });
    }
};
