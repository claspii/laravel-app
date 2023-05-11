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
        Schema::table('trangthaidonhang', function (Blueprint $table) {
            $table->foreign(['id_bill'], 'trangthaidonhang_ibfk_1')->references(['id'])->on('bill')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trangthaidonhang', function (Blueprint $table) {
            $table->dropForeign('trangthaidonhang_ibfk_1');
        });
    }
};
