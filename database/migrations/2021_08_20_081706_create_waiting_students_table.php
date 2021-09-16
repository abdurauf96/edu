<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWaitingStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiting_students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('course_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->date('year')->nullable();
            $table->string('address')->nullable();
            $table->string('passport')->nullable();
            $table->string('image')->nullable();
            $table->string('sex')->nullable();
            $table->string('type')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('waiting_students');
    }
}
