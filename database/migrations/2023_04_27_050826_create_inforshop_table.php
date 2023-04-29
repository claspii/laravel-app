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
        Schema::create('inforshop', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_account')->nullable()->index('id_shop');
            $table->string('name', 150);
            $table->string('address', 150);
            $table->string('image', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inforshop');
    }
};
