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
        Schema::create('vouncher', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('value');
            $table->integer('id_shop')->index('id_shop');
            $table->integer('number_of_vouncher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouncher');
    }
};
