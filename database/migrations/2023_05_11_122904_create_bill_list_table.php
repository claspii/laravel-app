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
        Schema::create('bill_list', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_bill')->index('id_bill');
            $table->integer('id_shop')->nullable()->index('id_shop');
            $table->integer('id_vouncher')->nullable()->index('id_vouncher');
            $table->integer('ship_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_list');
    }
};
