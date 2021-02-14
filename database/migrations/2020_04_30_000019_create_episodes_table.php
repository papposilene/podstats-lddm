<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('podcast_uuid');
            $table->foreign('podcast_uuid')
                ->references('uuid')->on('podcasts');
            $table->string('season', 255);
            $table->string('id', 255);
            $table->string('title', 255);
            $table->time('duration')->nullable();
            $table->date('aired_on');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('episodes');
    }
}
