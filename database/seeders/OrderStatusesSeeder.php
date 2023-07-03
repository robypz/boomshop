<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            ['status' => 'Exitoso'],
            ['status' => 'Pendiente'],
            ['status' => 'Procesando'],
            ['status' => 'Pago No Procesado'],
            ['status' => 'Datos Erroneos'],
        ]);
    }
}
