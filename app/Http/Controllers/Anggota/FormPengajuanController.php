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
        try {
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

            // cek pengajuan terakhir (1x dalam 3 bulan)
            $lastPengajuan = FormulirPengajuan::where('user_id', Auth::id())
                ->latest()
                ->first();

            if ($lastPengajuan && $lastPengajuan->created_at->diffInMonths(now()) < 3) {
                return redirect()->back()->with('error', 'Anda hanya dapat mengajukan pinjaman 1x dalam 3 bulan.');
            }

            // hitung total pinjaman berjalan
            $totalPinjamanBerjalan = FormulirPengajuan::where('user_id', Auth::id())
                ->where('status', 'disetujui')
                ->get()
                ->sum(function ($item) {
                    $data = json_decode($item->data_lengkap_json, true);
                    return $data['jumlah_pinjaman'] ?? 0;
                });

            // Hitung sisa limit
            $sisaLimit = $pangkat->maksimal_pinjaman - $totalPinjamanBerjalan;

            if ($sisaLimit <= 0) {
                return redirect()->back()->with('error', 'Anda masih memiliki pinjaman aktif, lunasi terlebih dahulu.');
            }

            if ($request->jumlah_pinjaman > $sisaLimit) {
                return redirect()->back()->with('error', 'Maksimal pengajuan saat ini Rp' . number_format($sisaLimit, 0, ',', '.'));
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
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
