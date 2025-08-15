<?php

namespace App\Http\Controllers\Staff;

use App\Models\Role;
use App\Models\User;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManagePenggunaController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'pangkat'])->get();
        $roles = Role::all();
        $pangkats = Pangkat::all();

        return view('pages.staff.manage-pengguna.index', compact('users', 'roles', 'pangkats'));
    }

    // Simpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'pangkat_id' => 'required|exists:pangkats,id',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'pangkat_id' => $request->pangkat_id,
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
    }


    // Tampilkan detail pengguna
    public function show($id)
    {
        $user = User::with(['role', 'pangkat'])->findOrFail($id);
        return response()->json($user);
    }

    // Update pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:100',
            'role_id' => 'required|exists:roles,id',
            'pangkat_id' => 'required|exists:pangkats,id',
        ]);

        $user->update([
            'username' => $request->name,
            'role_id' => $request->role_id,
            'pangkat_id' => $request->pangkat_id,
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Hapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
