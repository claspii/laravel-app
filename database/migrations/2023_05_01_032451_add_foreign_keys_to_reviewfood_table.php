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
        Schema::table('reviewfood', function (Blueprint $table) {
            $table->foreign(['id_food'], 'reviewfood_ibfk_1')->references(['id'])->on('food')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_shop'], 'reviewfood_ibfk_2')->references(['id'])->on('inforshop')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_user'], 'reviewfood_ibfk_3')->references(['id'])->on('inforuser')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviewfood', function (Blueprint $table) {
            $table->dropForeign('reviewfood_ibfk_1');
            $table->dropForeign('reviewfood_ibfk_2');
            $table->dropForeign('reviewfood_ibfk_3');
        });
    }
};
