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
        Schema::dropIfExists('chats_messages');
        
        Schema::create('chats_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message');
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('id_owner_message');
            $table->timestamps();
        });
        Schema::table('chats_messages', function($table) {
            $table->foreign('chat_id')->references('id')->on('chats');
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
