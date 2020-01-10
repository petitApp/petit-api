<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reported_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('report_reason');
            $table->unsignedBigInteger('id_reporter_owner');
            $table->unsignedBigInteger('id_reported_user');
            $table->string('comment');
            $table->timestamps();
        });
        Schema::table('reported_users', function($table) {
            $table->foreign('id_reporter_owner')->references('id')->on('users');
            $table->foreign('id_reported_user')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reported_users');
    }
}
