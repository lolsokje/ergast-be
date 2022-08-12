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
        Schema::create('circuits', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('circuit_ref', 50);
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->integer('alt')->nullable();
            $table->string('url');
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
