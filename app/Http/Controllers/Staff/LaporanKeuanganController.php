<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        return view('pages.staff.laporan-keuangan.index');
    }
}
