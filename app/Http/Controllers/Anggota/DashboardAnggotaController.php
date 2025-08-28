<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardAnggotaController extends Controller
{
    public function DashboardAnggota()
    {
        $pengajuans = FormulirPengajuan::where('user_id', Auth::id())->first();
        return view('pages.anggota.dashboard-anggota', compact('pengajuans'));
    }
}
