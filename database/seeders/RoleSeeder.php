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
        $roles=[
            [
                'id'=>1,
                'name'=>'admin',
                'label'=>'Adminstrator',
            ],
            [
                'id'=>2,
                'name'=>'cashier',
                'label'=>'Cashier',
            ],
            [
                'id'=>3,
                'name'=>'moder',
                'label'=>'Moderator',
            ],
        ];

        foreach($roles as $role){
            \App\Models\Role::create($role);
        }
        
    }
}
