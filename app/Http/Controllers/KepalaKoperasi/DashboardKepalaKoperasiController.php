<?php

namespace App\Http\Controllers\KepalaKoperasi;

use App\Models\Angsuran;
use Illuminate\Http\Request;
use App\Exports\AngsuranExport;
use App\Exports\PinjamanExport;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DashboardKepalaKoperasiController extends Controller
{
    public function DashboardKepalaKoperasi()
    {
        $pengajuans = FormulirPengajuan::with('user')->get();
        $jumlahPengajuanBaru = $pengajuans->where('status', 'pending')->count();
        $jumlahPengajuanTerverifikasi = $pengajuans->where('status', 'disetujui')->count();
        return view('pages.kepala-koperasi.dashboard-kepala', compact('pengajuans', 'jumlahPengajuanBaru', 'jumlahPengajuanTerverifikasi'));
    }

    public function validasi($id)
    {
        $pengajuan = FormulirPengajuan::findOrFail($id);
        $pengajuan->status = 'disetujui'; // atau 'diproses' jika ingin tahapan tengah
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan berhasil divalidasi.');
    }

    public function indexPinjaman()
    {
        $pinjamans = FormulirPengajuan::all();
        return view('pages.kepala-koperasi.data-pinjaman.index', compact('pinjamans'));
    }

    public function export()
    {
        return Excel::download(new PinjamanExport, 'data-pinjaman.xlsx');
    }

    public function indexAngsuran()
    {
        $angsurans = Angsuran::all();
        return view('pages.kepala-koperasi.data-angsuran.index', compact('angsurans'));
    }

    public function exportAngsuran()
    {
        return Excel::download(new AngsuranExport, 'data_angsuran_' . now()->format('Ymd_His') . '.xlsx');
    }
}
