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
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('appid', 255);
            $table->string('created_by', 255);
            $table->string('license', 255);
            $table->integer('create_time');
            $table->integer('last_online')->nullable();
            $table->boolean('hwid_lock')->default(false);
            $table->string('hwid', 255)->nullable();

            $table->integer('type')->default(1);
            $table->integer('value')->nullable()->comment("timestamp");
            $table->boolean('banned')->default(false);
            $table->string('ban_reason', 255)->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
};
