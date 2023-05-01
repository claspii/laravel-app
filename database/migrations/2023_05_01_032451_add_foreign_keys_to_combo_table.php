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
        Schema::table('combo', function (Blueprint $table) {
            $table->foreign(['id_shop'], 'combo_ibfk_1')->references(['id'])->on('inforshop')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo', function (Blueprint $table) {
            $table->dropForeign('combo_ibfk_1');
        });
    }
};
