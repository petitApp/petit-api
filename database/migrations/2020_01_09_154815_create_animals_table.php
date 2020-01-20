<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('id_type');
            $table->unsignedBigInteger('id_breed')->nullable();
            $table->boolean('sex');
            $table->integer('age');
            $table->string('location');
            $table->string('description');
            $table->boolean('available')->default('1');
            $table->string('prefered_photo');
            $table->unsignedBigInteger('id_owner');
            $table->unsignedBigInteger('id_adopter')->nullable();
            $table->string('reason_unavivale')->nullable();
            $table->timestamps();
        });

        Schema::table('animals', function($table) {
            $table->foreign('id_owner')->references('id')->on('users');
            $table->foreign('id_adopter')->references('id')->on('users');
            $table->foreign('id_type')->references('id')->on('animals_types');
            $table->foreign('id_breed')->references('id')->on('animal_breeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
