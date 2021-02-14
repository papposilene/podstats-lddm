<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->string('token', 40)->index();
            $table->boolean('accepted')->default(0);
            $table->timestamp('accepted_at')->nullable();
            $table->uuid('user_uuid')->nullable();
            $table->foreign('user_uuid')
                ->references('uuid')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_invitations');
    }
}
