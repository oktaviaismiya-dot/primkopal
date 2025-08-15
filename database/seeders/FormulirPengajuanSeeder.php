<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormulirPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('formulir_pengajuans')->insert([
            ['user_id' => 3, 'data_lengkap_json' => json_encode([
                'nama' => 'Agustina',
                'alamat' => 'Jl. Bahari Raya No.10',
                'pangkat' => 'Tamtama',
                'tujuan' => 'Renovasi rumah',
                'jumlah_diminta' => 8000000,
                'tenor' => 12,
            ])],
            ['user_id' => 5, 'data_lengkap_json' => json_encode([
                'nama' => 'Letkol Slamet',
                'alamat' => 'Asrama Letkol A1',
                'pangkat' => 'Letkol',
                'tujuan' => 'Modal usaha',
                'jumlah_diminta' => 20000000,
                'tenor' => 24,
            ])],
        ]);
    }
}