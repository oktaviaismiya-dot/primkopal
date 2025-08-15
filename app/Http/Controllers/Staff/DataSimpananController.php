<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\JenisSimpanan;
use App\Http\Controllers\Controller;

class DataSimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with(['user', 'jenisSimpanan'])->get();
        $users = User::all();
        $jenisSimpanans = JenisSimpanan::all();
        return view('pages.staff.data-simpanan.index', compact('simpanans', 'users', 'jenisSimpanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'jenis_simpanan_id' => 'required|exists:jenis_simpanans,id',
        ]);

        Simpanan::create($request->all());

        return redirect()->back()->with('success', 'Data simpanan berhasil ditambahkan');
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
}
