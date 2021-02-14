<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameHasConsolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videogames_has_consoles', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('game_uuid');
            $table->foreign('game_uuid')
                ->references('uuid')->on('videogames');
            $table->uuid('console_uuid');
            $table->foreign('console_uuid')
                ->references('uuid')->on('consoles');
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
        Schema::dropIfExists('videogames_has_consoles');
    }
}
