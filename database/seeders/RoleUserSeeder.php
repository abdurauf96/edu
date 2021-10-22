<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         return \App\Models\RoleUser::create([
             'role_id'=>1,
             'user_id'=>1,
         ]);
    }
}
