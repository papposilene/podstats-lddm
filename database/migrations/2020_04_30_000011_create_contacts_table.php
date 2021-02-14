<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
			$table->string('uname', 255)->unique();
            $table->enum('gender', ['unknown', 'feminine', 'masculine', 'neutral', 'band'])->default('unknown');
            $table->string('fname', 255)->nullable();
            $table->string('mname', 255)->nullable();
            $table->string('lname', 255)->nullable();
            $table->uuid('lives_at')->nullable();
            $table->foreign('lives_at')
                ->references('uuid')->on('countries');
            $table->year('born_on')->nullable();
            $table->uuid('born_at')->nullable();
            $table->foreign('born_at')
                ->references('uuid')->on('countries');
            $table->year('died_on')->nullable();
            $table->uuid('died_at')->nullable();
            $table->foreign('died_at')
                ->references('uuid')->on('countries');
            $table->text('biography')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
