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
        Schema::table('inforuser', function (Blueprint $table) {
            $table->foreign(['id_account'], 'inforuser_ibfk_1')->references(['id'])->on('account')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inforuser', function (Blueprint $table) {
            $table->dropForeign('inforuser_ibfk_1');
        });
    }
};
