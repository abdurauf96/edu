<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'id'=>1,
            'name'=>'Edu Admin',
            'email'=>'admin@admin.com',
            'password'=>\Hash::make('password'),
        ]);
        $user->assignRole('admin');
    }
}
