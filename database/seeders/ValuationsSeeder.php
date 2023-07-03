<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValuationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('valuations')->insert([
            ['name' => 'USD', 'value' => 1],
            ['name' => 'USD/VES', 'value' => 18.26],
            ['name' => 'USDT', 'value' => 1],
        ]);
    }
}
