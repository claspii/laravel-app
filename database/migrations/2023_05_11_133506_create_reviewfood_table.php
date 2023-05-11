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
        Schema::create('reviewfood', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_food')->nullable()->index('id_food');
            $table->integer('id_shop')->nullable()->index('id_shop');
            $table->integer('id_user')->nullable()->index('id_user');
            $table->string('des', 150);
            $table->date('thoigian');
            $table->integer('star');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewfood');
    }
};
