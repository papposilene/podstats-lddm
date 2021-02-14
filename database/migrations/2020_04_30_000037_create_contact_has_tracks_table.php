<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactHasTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_has_tracks', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('contact_uuid');
            $table->foreign('contact_uuid')
                ->references('uuid')->on('contacts');
			$table->uuid('track_uuid');
            $table->foreign('track_uuid')
                ->references('uuid')->on('tracks');
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
        Schema::dropIfExists('contact_has_tracks');
    }
}
