<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FormPengajuanController extends Controller
{
    public function index()
    {
        return view('pages.anggota.form-pengajuan.index');
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'jabatan' => 'required|string',
            'slip_gaji' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'jumlah_pinjaman' => 'required|numeric|min:1000000',
            'tenor' => 'required|in:12,24',
            'keperluan' => 'required|string|max:255',
            'bunga' => 'required|numeric',
        ]);

        // Upload slip gaji
        $slipPath = $request->file('slip_gaji')->store('slip_gaji', 'public');

        // Simpan semua data dalam bentuk JSON
        $dataLengkap = [
            'jabatan' => $request->jabatan,
            'slip_gaji_path' => $slipPath,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'tenor' => $request->tenor,
            'keperluan' => $request->keperluan,
            'bunga' => $request->bunga,
        ];

        // Simpan ke database
        FormulirPengajuan::create([
            'user_id' => Auth::id(),
            'data_lengkap_json' => json_encode($dataLengkap),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan pinjaman berhasil dikirim.');
    }
}
