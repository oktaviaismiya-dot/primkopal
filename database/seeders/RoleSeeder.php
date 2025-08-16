<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nama' => 'staff', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'kepala koperasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'anggota','created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
