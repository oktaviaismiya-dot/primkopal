<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    protected $fillable = ['nama'];

    public function simpanans()
    {
        return $this->hasMany(Simpanan::class);
    }
}
