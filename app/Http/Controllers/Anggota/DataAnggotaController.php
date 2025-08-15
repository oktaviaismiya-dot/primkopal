<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataAnggotaController extends Controller
{
   public function index()
    {
        return view('pages.anggota.dashboard-anggota');
    }
}
