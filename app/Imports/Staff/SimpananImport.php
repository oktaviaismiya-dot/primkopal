<?php

namespace App\Imports\Staff;

use App\Models\User;
use App\Models\Simpanan;
use App\Models\JenisSimpanan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SimpananImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('username', $row['username'])->first();
        $jenisSimpanan = JenisSimpanan::where('nama', $row['jenis_simpanan'])->first();
        return new Simpanan([
            'user_id' => $user ? $user->id : null,
            'jenis_simpanan_id' => $jenisSimpanan ? $jenisSimpanan->id : null,
            'jumlah' => $row['jumlah'],
            'tanggal' => $row['tanggal'],
        ]);
    }
}
