<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLaporanKeuangan extends Model
{
    protected $fillable = ['nama'];

    public function laporanKeuangans()
    {
        return $this->hasMany(LaporanKeuangan::class, 'jenis');
    }
}