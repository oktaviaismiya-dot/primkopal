<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'staff.lanal', 'password' => bcrypt('Staff123'), 'role_id' => 1, 'pangkat_id' => 2], // staff
            ['username' => 'kepala.kop', 'password' => bcrypt('KopHead456'), 'role_id' => 2, 'pangkat_id' => 4], // kepala koperasi
            ['username' => 'agustina', 'password' => bcrypt('Agus789'), 'role_id' => 3, 'pangkat_id' => 1], // anggota tamtama
            ['username' => 'bintara01', 'password' => bcrypt('Bin123'), 'role_id' => 3, 'pangkat_id' => 2],
            ['username' => 'letkol.slamet', 'password' => bcrypt('LetkolPass'), 'role_id' => 3, 'pangkat_id' => 4],
        ]);
    }
}
