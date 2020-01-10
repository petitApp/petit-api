<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message');
            $table->unsignedBigInteger('id_chat');
            $table->unsignedBigInteger('id_owner_message');
            $table->timestamps();
        });
        Schema::table('chats_messages', function($table) {
            $table->foreign('id_chat')->references('id')->on('chats');
            $table->foreign('id_owner_message')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats_messages');
    }
}
