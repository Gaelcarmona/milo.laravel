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
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned();
            $table->integer('deck_id')
                ->unsigned();
            $table->integer('match_id')
                ->unsigned();
            $table->integer('place');
            $table->integer('score');
            $table->timestamps();
        });
        Schema::table('results', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('deck_id')->references('id')->on('decks');
            $table->foreign('match_id')->references('id')->on('matchs');


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
        Schema::dropIfExists('results');
        Schema::enableForeignKeyConstraints();
    }
};
