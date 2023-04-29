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
        Schema::create('combofood', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_food')->nullable()->index('id_food');
            $table->integer('id_combo')->nullable()->index('id_combo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combofood');
    }
};
