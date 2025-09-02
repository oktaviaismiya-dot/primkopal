<?php

namespace App\Http\Controllers\Staff;

use App\Models\Role;
use App\Models\User;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::with(['role', 'pangkat'])->get();
        $roles = Role::all();
        $pangkats = Pangkat::all();
        return view('pages.staff.data-anggota.index', compact('anggota', 'roles', 'pangkats'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:100',
                'password' => 'required|string|max:100',
                'role_id' => 'required|exists:roles,id',
                'pangkat'  => 'required|string|max:100',
                'maksimal_pinjaman' => 'nullable|integer|min:0',
                // 'pangkat_id' => 'required|exists:pangkats,id',
            ]);

            // Cek pangkat berdasarkan nama
            $pangkat = Pangkat::where('nama', $request->pangkat)->first();
            if (!$pangkat) {
                Pangkat::create([
                    'nama' => $request->pangkat,
                    'maksimal_pinjaman' => $request->maksimal_pinjaman,
                ]);
            }

            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
                'pangkat_id' => $pangkat->id,
            ]);

            return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $user = User::with(['role', 'pangkat'])->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:100',
                'password' => 'nullable|string|max:100',
                'role_id' => 'required|exists:roles,id',
                'pangkat_id' => 'required|exists:pangkats,id',
            ]);

            $user = User::findOrFail($id);
            $user->username = $request->username;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->role_id = $request->role_id;
            $user->pangkat_id = $request->pangkat_id;
            $user->save();

            return redirect()->back()->with('success', 'Anggota berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Anggota berhasil dihapus');
    }
}
