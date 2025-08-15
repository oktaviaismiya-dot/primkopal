<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan_keuangans')->insert([
            ['user_id' => 2, 'tanggal' => now(), 'jenis' => 1, 'keterangan' => 'Setoran simpanan wajib dan pokok anggota bulan Juli'],
            ['user_id' => 2, 'tanggal' => now(), 'jenis' => 3, 'keterangan' => 'Pencairan pinjaman Letkol Slamet'],
        ]);
    }
}
