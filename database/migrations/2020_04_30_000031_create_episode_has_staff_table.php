<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeHasStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_has_staff', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('podcast_uuid');
            $table->foreign('podcast_uuid')
                ->references('uuid')->on('podcasts');
            $table->uuid('episode_uuid');
            $table->foreign('episode_uuid')
                ->references('uuid')->on('episodes');
            $table->uuid('contact_uuid');
            $table->foreign('contact_uuid')
                ->references('uuid')->on('contacts');
            $table->uuid('profession_uuid');
            $table->foreign('profession_uuid')
                ->references('uuid')->on('professions');
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
        Schema::dropIfExists('episode_has_staff');
    }
}
