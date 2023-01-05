<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableStudentsChangeOutedDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE students ALTER COLUMN 
        outed_date TYPE date USING (outed_date)::date');
        DB::statement('ALTER TABLE students ALTER COLUMN 
        finished_date TYPE date USING (finished_date)::date');
        DB::statement('ALTER TABLE students ALTER COLUMN 
        sertificat_date TYPE date USING (sertificat_date)::date');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
