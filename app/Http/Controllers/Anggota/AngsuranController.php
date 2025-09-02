<?php

namespace App\Http\Controllers\Anggota;

use App\Models\Angsuran;
use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AngsuranController extends Controller
{
    public function index()
    {
        $pengajuan = FormulirPengajuan::where('user_id', Auth::id())->get();
        $angsurans = collect();

        if ($pengajuan) {
            $angsurans = Angsuran::whereIn('formulir_pengajuan_id', $pengajuan->pluck('id'))
                ->with('formulirPengajuan.user')
                ->paginate(10);
        }

        return view('pages.anggota.angsuran.index', compact('angsurans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
            'angsuran_ke' => 'required|integer|min:1',
        ]);

        // Dapatkan pengajuan pinjaman user yang login
        $pengajuan = FormulirPengajuan::where('user_id', auth()->id())->first();

        if (!$pengajuan) {
            return back()->with('error', 'Anda belum memiliki pengajuan pinjaman');
        }

        $dataPinjaman = json_decode($pengajuan->data_lengkap_json, true);
        $jumlahPinjaman = (int) str_replace(['.', ','], '', $dataPinjaman['jumlah_pinjaman']);

        $totalSudahDibayar = Angsuran::where('formulir_pengajuan_id', $pengajuan->id)
            ->sum('jumlah_bayar');

        $sisaPembayaran = $jumlahPinjaman - ($totalSudahDibayar + $request->jumlah_bayar);


        Angsuran::create([
            'formulir_pengajuan_id' => $pengajuan->id,
            'tanggal' => $request->tanggal,
            'jumlah_bayar' => $request->jumlah_bayar,
            'angsuran_ke' => $request->angsuran_ke,
            'sisa_pembayaran' => $sisaPembayaran,
        ]);

        return back()->with('success', 'Angsuran berhasil ditambahkan');
    }

    public function cetakFaktur($id)
    {
        $angsuran = Angsuran::with(['formulirPengajuan.user'])
            ->findOrFail($id);

        // Verifikasi pemilik angsuran
        if ($angsuran->formulirPengajuan->user_id != auth()->id()) {
            abort(403);
        }

        return view('pages.anggota.angsuran.faktur', compact('angsuran'));
    }
}
