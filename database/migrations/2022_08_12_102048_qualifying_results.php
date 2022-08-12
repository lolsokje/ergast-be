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
        Schema::create('qualifying_results', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('race_id');
            $table->unsignedInteger('driver_id');
            $table->unsignedInteger('constructor_id');
            $table->unsignedInteger('number')->default(0);
            $table->unsignedInteger('position')->nullable();
            $table->string('q1', 10)->nullable();
            $table->string('q2', 10)->nullable();
            $table->string('q3', 10)->nullable();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('constructor_id')->references('id')->on('constructors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualifying_results', function (Blueprint $table) {
            //
        });
    }
};
