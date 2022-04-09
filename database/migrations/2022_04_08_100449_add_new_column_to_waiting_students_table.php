<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToWaitingStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('waiting_students', function (Blueprint $table) {
            $table->integer('district_id')->nullable();
            $table->string('study_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('waiting_students', function (Blueprint $table) {
            $table->dropColumn('district_id');
            $table->dropColumn('study_type');
        });
    }
}
