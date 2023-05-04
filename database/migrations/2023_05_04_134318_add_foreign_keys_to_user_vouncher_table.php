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
        Schema::table('user_vouncher', function (Blueprint $table) {
            $table->foreign(['id_vouncher'], 'user_vouncher_ibfk_2')->references(['id'])->on('vouncher')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_user'], 'user_vouncher_ibfk_3')->references(['id'])->on('account')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_vouncher', function (Blueprint $table) {
            $table->dropForeign('user_vouncher_ibfk_2');
            $table->dropForeign('user_vouncher_ibfk_3');
        });
    }
};
