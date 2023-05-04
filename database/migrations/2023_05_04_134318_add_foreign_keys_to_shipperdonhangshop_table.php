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
        Schema::table('shipperdonhangshop', function (Blueprint $table) {
            $table->foreign(['id_donhang'], 'shipperdonhangshop_ibfk_4')->references(['id'])->on('donhang')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_user'], 'shipperdonhangshop_ibfk_5')->references(['id'])->on('account')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_shop'], 'shipperdonhangshop_ibfk_6')->references(['id'])->on('account')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_shipper'], 'shipperdonhangshop_ibfk_7')->references(['id'])->on('account')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipperdonhangshop', function (Blueprint $table) {
            $table->dropForeign('shipperdonhangshop_ibfk_4');
            $table->dropForeign('shipperdonhangshop_ibfk_5');
            $table->dropForeign('shipperdonhangshop_ibfk_6');
            $table->dropForeign('shipperdonhangshop_ibfk_7');
        });
    }
};
