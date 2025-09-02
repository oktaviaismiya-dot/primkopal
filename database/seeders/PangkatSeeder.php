<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pangkats')->insert([
            ['nama' => 'Tamtama', 'maksimal_pinjaman' => 10000000, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bintara', 'maksimal_pinjaman' => 15000000, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Perwira', 'maksimal_pinjaman' => 20000000, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Letkol', 'maksimal_pinjaman' => 25000000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
