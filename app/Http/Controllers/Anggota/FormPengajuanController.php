<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Illuminate\Support\Facades\Auth;

class FormPengajuanController extends Controller
{
    public function index()
    {
        $pangkat = Pangkat::all();
        return view('pages.anggota.form-pengajuan.index', compact('pangkat'));
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'pangkat_id' => 'required|exists:pangkats,id',
            'slip_gaji' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'jumlah_pinjaman' => 'required|numeric|min:1000000',
            'tenor' => 'required|in:12,24',
            'keperluan' => 'required|string|max:255',
            'bunga' => 'required|numeric',
        ]);

        // Upload slip gaji
        $slipPath = $request->file('slip_gaji')->store('slip_gaji', 'public');

        // Ambil data pangkat
        $pangkat = Pangkat::findOrFail($request->pangkat_id);

        // Validasi maksimal pinjaman
        if ($request->jumlah_pinjaman > $pangkat->maksimal_pinjaman) {
            return redirect()->back()->with('error', 'Jumlah pinjaman melebihi batas maksimal pangkat Anda.');
        }

        // Simpan semua data dalam bentuk JSON
        // $dataLengkap = [
        //     'jabatan' => $request->jabatan,
        //     'slip_gaji_path' => $slipPath,
        //     'jumlah_pinjaman' => $request->jumlah_pinjaman,
        //     'tenor' => $request->tenor,
        //     'keperluan' => $request->keperluan,
        //     'bunga' => $request->bunga,
        // ];

        // Simpan ke database
        FormulirPengajuan::create([
            'user_id' => Auth::id(),
            'data_lengkap_json' => json_encode([
                'pangkat_id' => $request->pangkat_id,
                'slip_gaji_path' => $slipPath,
                'jumlah_pinjaman' => $request->jumlah_pinjaman,
                'tenor' => $request->tenor,
                'keperluan' => $request->keperluan,
                'bunga' => $request->bunga,
            ]),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan pinjaman berhasil dikirim.');
    }
}
