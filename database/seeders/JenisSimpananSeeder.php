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
            ['nama' => 'Simpanan Pokok', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Simpanan Wajib', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Simpanan Sukarela', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
