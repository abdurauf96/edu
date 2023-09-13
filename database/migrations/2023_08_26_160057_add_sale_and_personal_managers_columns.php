<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleAndPersonalManagersColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('sale_manager_id')->nullable();
            $table->integer('personal_manager_id')->nullable();
        });
        Schema::table('waiting_students', function (Blueprint $table) {
            $table->integer('sale_manager_id')->nullable();
            $table->integer('personal_manager_id')->nullable();
            $table->boolean('is_come_open_lesson')->default(false);
            $table->boolean('is_has_computer')->default(false);
            $table->boolean('is_informed ')->default(false);
            $table->boolean('is_contract_given')->default(false);
            $table->boolean('is_payed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('sale_manager_id');
            $table->dropColumn('personal_manager_id');
        });
        Schema::table('waiting_students', function (Blueprint $table) {
            $table->dropColumn('sale_manager_id');
            $table->dropColumn('personal_manager_id');
            $table->dropColumn('is_informed ');
            $table->dropColumn('is_has_computer');
            $table->dropColumn('is_come_open_lesson');
            $table->dropColumn('is_contract_given');
            $table->dropColumn('is_payed');
        });
    }
}
