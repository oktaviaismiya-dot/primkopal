<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $fillable = ['username', 'password', 'role_id', 'pangkat_id'];

    const ROLE_STAFF = 'staff';
    const ROLE_KEPALA_KOPERASI = 'kepala koperasi';
    const ROLE_ANGGOTA = 'anggota';

    public function isStaff() {
        return $this->role === self::ROLE_STAFF;
    }

    public function isKepsi() {
        return $this->role === self::ROLE_KEPALA_KOPERASI;
    }

    public function isAnggota() {
        return $this->role === self::ROLE_ANGGOTA;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class);
    }

    public function simpanans()
    {
        return $this->hasMany(Simpanan::class);
    }

    public function slipGajis()
    {
        return $this->hasMany(SlipGaji::class);
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class, 'anggota_id');
    }

    public function laporanKeuangans()
    {
        return $this->hasMany(LaporanKeuangan::class);
    }

    public function formulirPengajuans()
    {
        return $this->hasMany(FormulirPengajuan::class);
    }
}
