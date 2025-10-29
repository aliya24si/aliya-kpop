<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan form login
    public function index()
    {
        return view('admin.login');
    }

    // Proses login (store)
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.'
        ]);

        // Cek user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.')->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah.')->withInput();
        }

        // Login berhasil
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index')->with('success', 'Anda telah logout.');
    }
}
