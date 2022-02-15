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
        Schema::create('kills', function (Blueprint $table) {
            $table->integer('result_id')
                ->unsigned();
            $table->integer('user_killed_id')
                ->unsigned();
            $table->timestamps();
        });
        Schema::table('kills', function (Blueprint $table) {
            $table->foreign('result_id')->references('id')->on('results');
            $table->foreign('user_killed_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('kills');
        Schema::enableForeignKeyConstraints();
    }
};
