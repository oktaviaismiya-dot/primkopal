<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $fillable = ['user_id', 'jumlah', 'tanggal', 'jenis_simpanan_id'];

    public function getTanggalFormattedAttribute() {
        return \Carbon\Carbon::parse($this->tanggal)->locale('id')->translatedFormat('d F Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisSimpanan()
    {
        return $this->belongsTo(JenisSimpanan::class);
    }
}
