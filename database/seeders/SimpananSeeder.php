<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SimpananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('simpanans')->insert([
            ['user_id' => 3, 'jumlah' => 5000, 'tanggal' => now(), 'jenis_simpanan_id' => 1],
            ['user_id' => 3, 'jumlah' => 20000, 'tanggal' => now(), 'jenis_simpanan_id' => 2],
            ['user_id' => 3, 'jumlah' => 75000, 'tanggal' => now(), 'jenis_simpanan_id' => 3],
            ['user_id' => 4, 'jumlah' => 5000, 'tanggal' => now(), 'jenis_simpanan_id' => 1],
            ['user_id' => 5, 'jumlah' => 5000, 'tanggal' => now(), 'jenis_simpanan_id' => 1],
        ]);
    }
}
