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
        Schema::table('cartfood', function (Blueprint $table) {
            $table->foreign(['id_food'], 'cartfood_ibfk_1')->references(['id'])->on('food')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_vouncher'], 'cartfood_ibfk_2')->references(['id'])->on('vouncher')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartfood', function (Blueprint $table) {
            $table->dropForeign('cartfood_ibfk_1');
            $table->dropForeign('cartfood_ibfk_2');
        });
    }
};
