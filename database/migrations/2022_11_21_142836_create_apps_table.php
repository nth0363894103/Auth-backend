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
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('appid', 255)->unique();
            $table->string('created_by', 255);
            $table->string('fullname', 255);
            $table->boolean('enabled')->default(true);
            $table->string('disabled_reason')->nullable();
            $table->boolean('cooldown_when_disabled')->default(false);
            $table->string('version', 255)->nullable();
            $table->string('download_link', 255)->nullable();
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
        Schema::dropIfExists('apps');
    }
};
