<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consoles', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('manufacturer_uuid');
            $table->foreign('manufacturer_uuid')
                ->references('uuid')->on('manufacturers');
            $table->enum('type', ['arcade', 'handheld', 'home', 'micro', 'computer', 'hybrid'])->default('handheld');
            $table->string('generation', 255)->nullable();
            $table->string('name', 255)->unique();
            $table->year('released_on')->nullable();
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
        Schema::dropIfExists('consoles');
    }
}
