<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sprint_results', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('race_id');
            $table->unsignedInteger('driver_id');
            $table->unsignedInteger('constructor_id');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('number')->nullable();
            $table->unsignedInteger('grid');
            $table->unsignedInteger('position')->nullable();
            $table->string('position_text', 10);
            $table->unsignedInteger('position_order');
            $table->float('points')->default(0);
            $table->unsignedInteger('laps')->default(0);
            $table->string('time', 10)->nullable();
            $table->unsignedInteger('milliseconds')->nullable();
            $table->unsignedInteger('fastest_lap_number')->nullable();
            $table->string('fastest_lap_time', 10)->nullable();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('constructor_id')->references('id')->on('constructors');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sprint_results');
    }
};
