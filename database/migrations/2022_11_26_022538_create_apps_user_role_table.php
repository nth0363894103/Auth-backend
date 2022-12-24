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
        Schema::create('apps_user_role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid', 255);
            $table->string('appid', 255);
            $table->string('role', 255)->default("admin");
            $table->integer('max_license')->nullable()->comment("max license seller can create");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps_user_role');
    }
};
