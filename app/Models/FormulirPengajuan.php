<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormulirPengajuan extends Model
{
    protected $fillable = ['user_id', 'data_lengkap_json', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function angsuran() {
        return $this->hasMany(Angsuran::class);
    }

    public function getCreatedAtFormattedAttribute() {
        return Carbon::parse($this->created_at)->locale('id')->translatedFormat('d F Y');
    }
}
