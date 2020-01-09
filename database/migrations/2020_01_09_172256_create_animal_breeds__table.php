<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_breeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('animal_type');
            $table->string('breed_name');

            $table->timestamps();
        });
        Schema::table('animal_breeds', function($table) {
            $table->foreign('animal_type')->references('id')->on('animals_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_breeds');
    }
}
