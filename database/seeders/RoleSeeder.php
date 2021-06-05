<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \App\Models\Role::create([
            'id'=>1,
            'name'=>'admin',
            'label'=>'Adminstrator',
        ]);
    }
}
