<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{

    protected $table = 'pinjamans';

    protected $fillable = ['anggota_id', 'tanggal_pengajuan', 'jumlah', 'status', 'tenor', 'bunga', 'slip_gaji_id'];

    public function getTanggalFormattedAttribute() {
        return \Carbon\Carbon::parse($this->tanggal_pengajuan)->locale('id')->translatedFormat('d F Y');
    }
    public function anggota()
    {
        return $this->belongsTo(User::class, 'anggota_id');
    }

    public function slipGaji()
    {
        return $this->belongsTo(SlipGaji::class);
    }

    public function angsurans()
    {
        return $this->hasMany(Angsuran::class);
    }
}
