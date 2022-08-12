<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('year');
            $table->unsignedInteger('round');
            $table->unsignedInteger('circuit_id');
            $table->string('name');
            $table->date('date')->default('1970-01-01');
            $table->time('time')->nullable();
            $table->string('url')->nullable();
            $table->date('fp1_date')->nullable();
            $table->time('fp1_time')->nullable();
            $table->date('fp2_date')->nullable();
            $table->time('fp2_time')->nullable();
            $table->date('fp3_date')->nullable();
            $table->time('fp3_time')->nullable();
            $table->date('quali_date')->nullable();
            $table->time('quali_time')->nullable();
            $table->date('sprint_date')->nullable();
            $table->time('sprint_time')->nullable();

            $table->foreign('year')->references('year')->on('seasons');
            $table->foreign('circuit_id')->references('id')->on('circuits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
