<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pitstops', function (Blueprint $table) {
            $table->unsignedInteger('race_id');
            $table->unsignedInteger('driver_id');
            $table->unsignedInteger('stop');
            $table->unsignedInteger('lap');
            $table->time('time');
            $table->string('duration', 10)->nullable();
            $table->unsignedInteger('milliseconds')->nullable();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('driver_id')->references('id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitstops');
    }
};
