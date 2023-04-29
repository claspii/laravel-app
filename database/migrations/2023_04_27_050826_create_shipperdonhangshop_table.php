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
        Schema::create('shipperdonhangshop', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->nullable()->index('id_user');
            $table->integer('id_shipper')->nullable()->index('id_shipper');
            $table->integer('id_shop')->nullable()->index('id_shop');
            $table->integer('id_donhang')->nullable()->index('id_donhang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipperdonhangshop');
    }
};
