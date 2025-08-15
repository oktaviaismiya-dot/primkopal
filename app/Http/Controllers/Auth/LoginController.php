<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('Auth.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            Log::info('Login berhasil oleh user: ' . $user->username . ' dengan role: ' . $user->role->nama);

            if ($user->role->nama === 'staff') {
                return redirect()->route('staff.dashboard');
            } elseif ($user->role->nama === 'kepala koperasi') {
                return redirect()->route('pages.kepala-koperasi.dashboard-kepala');
            } elseif ($user->role->nama === 'anggota') {
                return redirect()->route('anggota.dashboard-anggota');
            } else {
                return redirect()->route('login')->withErrors(['username' => 'Role tidak dikenali.']);
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
        // return view('Auth.login');
    }

    public function logout(Request $request)
    {
        // Log::info('Logout dipanggil oleh user ID: ' . Auth::id());
        Auth::logout();

        // Hapus session dan regenerasi CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Arahkan ke halaman login
    }
}
