<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
     protected $fillable = ['user_id', 'bulan', 'nominal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
