<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_id')->unique();
            $table->integer('course_id')->nullable();
            $table->string('fio')->nullable();
            $table->string('phone')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('finished')->nullable();
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
        Schema::dropIfExists('bot_students');
    }
}
