<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pinjamans')->insert([
            ['anggota_id' => 3, 'tanggal_pengajuan' => now(), 'jumlah' => 8000000, 'status' => 'disetujui', 'tenor' => 12, 'bunga' => 1.00, 'slip_gaji_id' => 1],
            ['anggota_id' => 4, 'tanggal_pengajuan' => now(), 'jumlah' => 10000000, 'status' => 'pending', 'tenor' => 18, 'bunga' => 1.00, 'slip_gaji_id' => 2],
            ['anggota_id' => 5, 'tanggal_pengajuan' => now(), 'jumlah' => 20000000, 'status' => 'dicairkan', 'tenor' => 24, 'bunga' => 1.00, 'slip_gaji_id' => 3],
        ]);
    }
}