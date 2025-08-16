<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use App\Models\Angsuran;

class DashboardStaffController extends Controller
{
    public function DashboardStaff()
    {
        $nasabah =  User::where('role_id', 3)->count();
        $simpanan = Simpanan::whereHas('user', function ($q) {
            $q->where('role_id', 3);
        })->sum('jumlah');
        $pinjaman = FormulirPengajuan::whereHas('user', function ($q) {
            $q->where('role_id', 3);
        })->sum('data_lengkap_json->jumlah_pinjaman');
        $angsuran = Angsuran::whereHas('formulirPengajuan.user', function ($q) {
            $q->where('role_id', 3);
        })->sum('jumlah_bayar');
        return view('dashboard', [
            'nasabah' => $nasabah,
            'pinjaman' => $pinjaman,
            'simpanan' => $simpanan,
            'angsuran' => $angsuran,
        ]);
    }
}
