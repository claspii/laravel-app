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
        Schema::table('bill_list', function (Blueprint $table) {
            $table->foreign(['id_bill'], 'bill_list_ibfk_1')->references(['id'])->on('donhang')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_food'], 'bill_list_ibfk_2')->references(['id'])->on('food')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_list', function (Blueprint $table) {
            $table->dropForeign('bill_list_ibfk_1');
            $table->dropForeign('bill_list_ibfk_2');
        });
    }
};
