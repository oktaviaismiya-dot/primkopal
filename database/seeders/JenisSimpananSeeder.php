<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisSimpananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_simpanans')->insert([
            ['nama' => 'Simpanan Pokok'],
            ['nama' => 'Simpanan Wajib'],
            ['nama' => 'Simpanan Sukarela'],
        ]);
    }
}
