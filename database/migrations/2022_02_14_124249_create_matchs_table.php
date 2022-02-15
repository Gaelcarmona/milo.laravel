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
        Schema::create('matchs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('championship_id')->unsigned();
            $table->unsignedInteger('image_id')
                ->nullable();
            $table->timestamps();
        });
        Schema::table('matchs', function (Blueprint $table) {
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('championship_id')->references('id')->on('championships');

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
        Schema::dropIfExists('matchs');
        Schema::enableForeignKeyConstraints();
    }
};
