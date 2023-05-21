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
        Schema::create('replyreview', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->nullable()->index('id_user');
            $table->text('des')->nullable();
            $table->text('image')->nullable();
            $table->integer('id_review')->nullable()->index('id_review');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replyreview');
    }
};
