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
        Schema::table('combofood', function (Blueprint $table) {
            $table->foreign(['id_food'], 'combofood_ibfk_1')->references(['id'])->on('food')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_combo'], 'combofood_ibfk_2')->references(['id'])->on('combo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combofood', function (Blueprint $table) {
            $table->dropForeign('combofood_ibfk_1');
            $table->dropForeign('combofood_ibfk_2');
        });
    }
};
