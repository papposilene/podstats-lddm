<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemHasDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_has_detail', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('item_uuid');
            $table->string('item_model', 255);
            $table->string('type', 255);
            $table->string('data', 255);
            $table->integer('clicks')->default(0);
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
        Schema::dropIfExists('item_has_detail');
    }
}
