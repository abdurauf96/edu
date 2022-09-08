<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
                'name'=>'super-admin',
                'guard_name'=>'admin',
            ],
            [
                'id'=>2,
                'name'=>'xtb',
                'guard_name'=>'admin',
            ],
            [
                'id'=>3,
                'name'=>'admin',
                'guard_name'=>'user',
            ],
            [
                'id'=>4,
                'name'=>'cashier',
                'guard_name'=>'user',
            ],
            [
                'id'=>5,
                'name'=>'manager',
                'guard_name'=>'user',
            ],
            [
                'id'=>6,
                'name'=>'creator',
                'guard_name'=>'user',
            ],
            [
                'id'=>7,
                'name'=>'viewer',
                'guard_name'=>'user',
            ],
        ];

        foreach($roles as $role){
            Role::create($role);
        }
        $admin=Admin::find(1);

        $admin->assignRole('super-admin');

    }
}
