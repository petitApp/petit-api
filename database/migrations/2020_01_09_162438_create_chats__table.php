<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('chats');
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_animal_owner');
            $table->unsignedBigInteger('id_adopter');
            $table->unsignedBigInteger('id_animal');
            $table->unique(['id_animal_owner', 'id_adopter', 'id_animal']);
            $table->boolean('active')->default('1');
            $table->timestamps();
        });
        Schema::table('chats', function($table) {
            $table->foreign('id_animal_owner')->references('id')->on('users');
            $table->foreign('id_adopter')->references('id')->on('users');
            $table->foreign('id_animal')->references('id')->on('animals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
