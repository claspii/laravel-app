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
        Schema::table('account', function (Blueprint $table) {
            $table->foreign(['id_role'], 'account_ibfk_1')->references(['id'])->on('role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account', function (Blueprint $table) {
            $table->dropForeign('account_ibfk_1');
        });
    }
};
