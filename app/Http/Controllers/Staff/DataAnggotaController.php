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
        $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:100',
            'role_id' => 'required|exists:roles,id',
            'pangkat_id' => 'required|exists:pangkats,id',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'pangkat_id' => $request->pangkat_id,
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
    }

    public function show($id)
    {
        $user = User::with(['role', 'pangkat'])->findOrFail($id);
         return response()->json($user);
    }

    public function update(Request $request, $id)
    {
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
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Anggota berhasil dihapus');
    }
}
