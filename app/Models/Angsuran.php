<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{

    protected $table = 'angsuran';
    protected $fillable = ['formulir_pengajuan_id', 'tanggal', 'angsuran_ke', 'jumlah_bayar', 'sisa_pembayaran'];

    public function formulirPengajuan()
    {
        return $this->belongsTo(FormulirPengajuan::class);
    }
}
