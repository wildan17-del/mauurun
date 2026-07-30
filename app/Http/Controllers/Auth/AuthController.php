<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Tampilkan form login (dipakai bersama oleh Admin & Peserta).
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login berdasarkan username & password.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            return $user->isAdmin()
                ? redirect()->intended(route('admin.dashboard'))
                : redirect()->intended(route('peserta.events.index'));
        }

        return back()
            ->withErrors(['username' => 'Username atau password yang Anda masukkan salah.'])
            ->onlyInput('username');
    }

    /**
     * Tampilkan form registrasi akun Peserta.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi akun baru sebagai Peserta.
     * peserta hanya mengisi Username dan Password.
     */
    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:4', 'max:50', 'unique:users,username', 'alpha_dash'],
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'username.unique' => 'Username tersebut sudah digunakan, silakan pilih username lain.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK tersebut sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'nik' => $request->nik,
            'password' => $request->password,
            'role' => 'peserta',
        ]);

        Auth::login($user);

        return redirect()->route('peserta.events.index')
            ->with('status', 'Registrasi berhasil! Selamat datang di Mau Run, '.$user->username.'.');
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah berhasil logout.');
    }
}
