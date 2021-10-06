<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return collect([
            ['name'=>'Yanvar', 'number'=>1],
            ['name'=>'Fevral', 'number'=>2],
            ['name'=>'Mart', 'number'=>3],
            ['name'=>'Aprel', 'number'=>4],
            ['name'=>'May', 'number'=>5],
            ['name'=>'Iyun', 'number'=>6],
            ['name'=>'Iyul', 'number'=>7],
            ['name'=>'Avgust', 'number'=>8],
            ['name'=>'Sentyabr', 'number'=>9],
            ['name'=>'Oktyabr', 'number'=>10],
            ['name'=>'Noyabr', 'number'=>11],
            ['name'=>'Dekabr', 'number'=>12],
        ])->each(function ($data) {
            Month::create($data);
        });
    }
}
