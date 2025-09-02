<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\JenisSimpanan;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Staff\SimpananExport;

class DataSimpananController extends Controller
{
    public function index(Request $request)
    {
        $simpanans = Simpanan::with(['user', 'jenisSimpanan'])->when($request->month, function ($query) use ($request) {
            return $query->whereMonth('tanggal', $request->month);
        })
            ->when($request->jenis_simpanan_id, function ($query) use ($request) {
                return $query->where('jenis_simpanan_id', $request->jenis_simpanan_id);
            })->get();
        $users = User::all();
        $jenisSimpanans = JenisSimpanan::all();
        return view('pages.staff.data-simpanan.index', compact('simpanans', 'users', 'jenisSimpanans'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'tanggal' => 'required|date',
                'jumlah' => 'required|numeric',
                'jenis_simpanan_id' => 'required|exists:jenis_simpanans,id',
            ]);

            Simpanan::create($request->all());

            return redirect()->back()->with('success', 'Data simpanan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $simpanan = Simpanan::with(['user', 'jenisSimpanan'])->findOrFail($id);
        return response()->json($simpanan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'jenis_simpanan_id' => 'required|exists:jenis_simpanans,id',
        ]);

        $simpanan = Simpanan::findOrFail($id);
        $simpanan->update($request->all());

        return redirect()->back()->with('success', 'Data simpanan berhasil diupdate');
    }

    public function destroy($id)
    {
        Simpanan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data simpanan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $month = $request->month;
        $jenis = $request->jenis_simpanan_id;

        // Ambil tanggal hari ini
        $today = Carbon::now()->translatedFormat('d_F_Y'); // contoh: 16_Agustus_2025

        // Ambil nama jenis simpanan (kalau ada)
        $jenisName = '';
        if ($jenis) {
            $jenisModel = JenisSimpanan::find($jenis);
            $jenisName = $jenisModel ? strtolower(str_replace(' ', '_', $jenisModel->nama)) : 'jenis_' . $jenis;
        }

        // Susun nama file
        $fileName = 'data_simpanan_' . $today;
        if ($jenisName) {
            $fileName .= '_' . $jenisName;
        }
        $fileName .= '.xlsx';

        return Excel::download(new SimpananExport($month, $jenis), $fileName);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        Excel::import(new \App\Imports\Staff\SimpananImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data simpanan berhasil diimport');
    }
}
