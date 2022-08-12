<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('laptimes', function (Blueprint $table) {
            $table->unsignedInteger('race_id');
            $table->unsignedInteger('driver_id');
            $table->unsignedInteger('lap');
            $table->unsignedInteger('position')->nullable();
            $table->string('time', 15)->nullable();
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
        Schema::dropIfExists('laptimes');
    }
};
