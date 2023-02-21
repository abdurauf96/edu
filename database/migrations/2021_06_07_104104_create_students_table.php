<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('year')->nullable();
            $table->string('address')->nullable();
            $table->string('passport')->nullable();
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->string('sex')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('password')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
