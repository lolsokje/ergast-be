<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('constructors', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('constructor_ref', 50);
            $table->string('name');
            $table->string('nationality')->nullable();
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
