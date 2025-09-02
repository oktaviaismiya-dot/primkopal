<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function index() {
        $pinjaman = FormulirPengajuan::where('user_id', Auth::id())->paginate(10);
        return view('pages.anggota.pinjaman.index', compact('pinjaman'));
    }
}
