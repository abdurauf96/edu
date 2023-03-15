<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'id'=>1,
            'name'=>'Super admin',
            'email'=>'admin@admin.com',
            'password'=>\Hash::make('password'),
        ]);
    }
}
