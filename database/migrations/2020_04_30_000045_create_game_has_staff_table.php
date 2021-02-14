<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameHasStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videogames_has_staff', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('game_uuid');
            $table->foreign('game_uuid')
                ->references('uuid')->on('videogames');
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
        Schema::dropIfExists('videogames_has_staff');
    }
}
