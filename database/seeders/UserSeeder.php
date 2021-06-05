<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \App\Models\User::create([
            'id'=>1,
            'name'=>'Adminstrator',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password'),
        ]);
    }
}
