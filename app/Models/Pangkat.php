<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $fillable = ['nama', 'maksimal_pinjaman'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
