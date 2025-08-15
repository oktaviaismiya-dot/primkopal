<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SlipGajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('slip_gajis')->insert([
            ['user_id' => 3, 'bulan' => '2025-07', 'nominal' => 4500000],
            ['user_id' => 4, 'bulan' => '2025-07', 'nominal' => 5000000],
            ['user_id' => 5, 'bulan' => '2025-07', 'nominal' => 9000000],
        ]);
    }
}