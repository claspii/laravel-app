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
        Schema::create('bill', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('price');
            $table->integer('payment_method')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->integer('id_state')->nullable()->index('id_state');
            $table->integer('id_user')->nullable()->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill');
    }
};
