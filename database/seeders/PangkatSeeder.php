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
            ['nama' => 'Tamtama', 'maksimal_pinjaman' => 10000000],
            ['nama' => 'Bintara', 'maksimal_pinjaman' => 15000000],
            ['nama' => 'Perwira', 'maksimal_pinjaman' => 20000000],
            ['nama' => 'Letkol', 'maksimal_pinjaman' => 25000000],
        ]);
    }
}
