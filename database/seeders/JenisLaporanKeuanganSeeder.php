<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisLaporanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_laporan_keuangans')->insert([
            ['nama' => 'Simpanan Anggota'],
            ['nama' => 'Pengeluaran Kantor'],
            ['nama' => 'Pencairan Pinjaman'],
            ['nama' => 'Pendapatan Bunga'],
        ]);
    }
}