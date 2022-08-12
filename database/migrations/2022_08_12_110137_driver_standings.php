<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('driver_standings', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('race_id');
            $table->unsignedInteger('driver_id');
            $table->float('points');
            $table->unsignedInteger('position')->nullable();
            $table->string('position_text')->nullable();
            $table->unsignedInteger('wins')->default(0);

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
        Schema::dropIfExists('driver_standings');
    }
};
