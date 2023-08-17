<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registered_id')->comment('users');
            $table->foreign('registered_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->string('shop_name');
            $table->string('area');
            $table->string('genre');
            $table->text('shop_desc');
            $table->text('pic_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
};