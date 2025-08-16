<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Pinjaman;
use App\Models\SlipGaji;
use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;

class DataPinjamanController extends Controller
{
    public function index(Request $request)
    {
        $pengajuans = FormulirPengajuan::with('user')->when($request->month, function($query) use ($request) {
            return $query->whereMonth('created_at', $request->month);
        })
        ->latest()
        ->paginate(10);
        $users = User::all();
        return view('pages.staff.data-pinjaman.index', compact('pengajuans', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'user_id' => 'required|exists:users,id', // tambahan validasi user yang dipilih
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
            'user_id' => $request->user_id, // pakai data dari input, bukan Auth::id()
            'data_lengkap_json' => json_encode($dataLengkap),
            'status' => 'pending',
        ]);


        return redirect()->back()->with('success', 'Data pinjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::with('anggota')->findOrFail($id);
        return response()->json($pinjaman);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anggota_id' => 'nullable|exists:users,id',
            'tanggal_pengajuan' => 'nullable|date',
            'jumlah' => 'nullable|numeric',
            'tenor' => 'nullable|integer',
            'status' => 'nullable|in:pending,disetujui,ditolak,dicairkan,lunas',
        ]);

        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update($request->only(['anggota_id', 'tanggal_pengajuan', 'jumlah', 'tenor', 'status']));

        return redirect()->back()->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pinjaman::destroy($id);
        return redirect()->back()->with('success', 'Data pinjaman berhasil dihapus.');
    }
}
