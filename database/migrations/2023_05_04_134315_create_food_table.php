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
        Schema::create('food', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 50);
            $table->integer('first_price')->nullable();
            $table->integer('last_price')->nullable();
            $table->string('name', 50)->nullable();
            $table->integer('id_shop')->nullable()->index('id_shop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
};
