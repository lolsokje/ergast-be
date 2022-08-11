<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('driver_ref', 50);
            $table->unsignedInteger('number')->nullable();
            $table->string('code', 3)->nullable();
            $table->string('given_name');
            $table->string('surname');
            $table->date('dob')->nullable();
            $table->string('nationality')->nullable();
            $table->string('url');
            $table->timestamps();
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
