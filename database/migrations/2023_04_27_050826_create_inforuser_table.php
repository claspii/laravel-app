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
        Schema::create('inforuser', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_account')->nullable()->index('ID_Account');
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('phone_number', 11);
            $table->string('address', 150);
            $table->string('avatar', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inforuser');
    }
};
