<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AngsuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('angsuran')->insert([
            ['pinjaman_id' => 1, 'tanggal' => now(), 'jumlah_bayar' => 1000000, 'sisa_pembayaran' => 7000000],
            ['pinjaman_id' => 3, 'tanggal' => now(), 'jumlah_bayar' => 3000000, 'sisa_pembayaran' => 17000000],
        ]);
    }
}
