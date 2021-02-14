<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeHasTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_has_tracks', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('podcast_uuid');
            $table->foreign('podcast_uuid')
                ->references('uuid')->on('podcasts');
            $table->uuid('episode_uuid');
            $table->foreign('episode_uuid')
                ->references('uuid')->on('episodes');
            $table->uuid('game_uuid');
            $table->foreign('game_uuid')
                ->references('uuid')->on('videogames');
            $table->uuid('track_uuid');
            $table->foreign('track_uuid')
                ->references('uuid')->on('tracks');
            $table->integer('track_id');
            $table->enum('track_type', ['actuality', 'tracklist', 'cover', 'other'])->default('other');
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
        Schema::dropIfExists('episode_has_tracks');
    }
}
