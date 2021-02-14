<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameHasGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videogames_has_genres', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('game_uuid');
            $table->foreign('game_uuid')
                ->references('uuid')->on('videogames');
            $table->uuid('genre_uuid');
            $table->foreign('genre_uuid')
                ->references('uuid')->on('videogames_genres');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videogames_has_genres');
    }
}
