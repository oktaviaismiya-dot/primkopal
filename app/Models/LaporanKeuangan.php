<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    protected $fillable = ['user_id', 'tanggal', 'jenis', 'keterangan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisLaporan()
    {
        return $this->belongsTo(JenisLaporanKeuangan::class, 'jenis');
    }
}
