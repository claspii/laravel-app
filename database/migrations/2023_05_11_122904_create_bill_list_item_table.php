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
        Schema::create('bill_list_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_food')->nullable()->index('id_food');
            $table->integer('id_listbill')->nullable()->index('id_listbill');
            $table->integer('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_list_item');
    }
};
