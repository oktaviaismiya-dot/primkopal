<?php

namespace App\Http\Controllers\Staff;

use App\Exports\Staff\StaffAngsuranExport;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Models\FormulirPengajuan;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DataAngsuranController extends Controller
{
    public function index(Request $request)
    {
        $formulirs = FormulirPengajuan::with('user')->get();
        $angsuranList = Angsuran::with('formulirPengajuan.user')
        ->when($request->month, function($query) use ($request) {
            return $query->whereMonth('tanggal', $request->month);
        })
        ->get();

        return view('pages.staff.data-angsuran.index', compact('angsuranList', 'formulirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'formulir_pengajuan_id' => 'required|exists:formulir_pengajuans,id',
            'tanggal' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
            'angsuran_ke' => 'required|integer|min:0',
        ]);

        $pengajuan = FormulirPengajuan::find($request->formulir_pengajuan_id);

        if (!$pengajuan) {
            return back()->with('error', 'Anda belum memiliki pengajuan pinjaman');
        }

        $dataPinjaman = json_decode($pengajuan->data_lengkap_json, true);
        $jumlahPinjaman = (int) str_replace(['.', ','], '', $dataPinjaman['jumlah_pinjaman']);

        $totalSudahDibayar = Angsuran::where('formulir_pengajuan_id', $pengajuan->id)
            ->sum('jumlah_bayar');

        $sisaPembayaran = $jumlahPinjaman - ($totalSudahDibayar + $request->jumlah_bayar);

        Angsuran::create([
            'formulir_pengajuan_id' => $request->formulir_pengajuan_id,
            'tanggal' => $request->tanggal,
            'jumlah_bayar' => $request->jumlah_bayar,
            'angsuran_ke' => $request->angsuran_ke,
            'sisa_pembayaran' => $sisaPembayaran,
        ]);

        return redirect()->back()->with('success', 'Angsuran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $angsuran = Angsuran::with('formulirPengajuan.user')->findOrFail($id);

        return response()->json([
            'id' => $angsuran->id,
            'tanggal' => $angsuran->tanggal,
            'jumlah_bayar' => $angsuran->jumlah_bayar,
            'angsuran_ke' => $angsuran->angsuran_ke,
            'sisa_pembayaran' => $angsuran->sisa_pembayaran,
            'username' => $angsuran->formulirPengajuan->user->username ?? 'N/A',
        ]);
    }

    public function update(Request $request, $id)
    {
        $angsuran = Angsuran::findOrFail($id);

        $angsuran->update([
            'tanggal' => $request->tanggal,
            'jumlah_bayar' => $request->jumlah_bayar,
            'angsuran_ke' => $request->angsuran_ke,
            // 'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Angsuran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $angsuran->delete();

        return redirect()->back()->with('success', 'Data angsuran berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $month = $request->month;

        $fileName = 'data_angsuran.xlsx';
        if ($month) {
            $fileName = 'data_angsuran_' . now()->format('Y_m') . '_' . $month . '.xlsx';
        }

        return Excel::download(new StaffAngsuranExport($month), $fileName);
    }
}
