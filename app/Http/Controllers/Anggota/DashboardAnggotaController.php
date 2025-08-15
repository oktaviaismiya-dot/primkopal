<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAnggotaController extends Controller
{
    public function DashboardAnggota()
    {
        return view('pages.anggota.dashboard-anggota');
    }
}
