<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password; // untuk password broker
use App\Models\User;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            // Cek role admin
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->back()->with('error', 'Akses ditolak, Anda bukan admin')->withInput();
        }

        // Jika login gagal
        return redirect()->back()
                         ->with('error', 'Email atau password salah')
                         ->withInput(); // supaya input email tetap ada
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login'); // redirect ke halaman login admin
    }

    // =========================
    // Forgot Password Admin
    // =========================

    // Tampilkan form forgot password
    public function showForgotForm()
    {
        // Mengacu pada view resources/views/admin/passwords/email.blade.php
        return view('admin.password.email');
    }

    // Kirim link reset password via email
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Pastikan admin ada
        $admin = User::where('email', $request->email)
                     ->where('role', 'admin')
                     ->first();

        if (!$admin) {
            return back()->with('error', 'Email admin tidak ditemukan');
        }

        // Kirim link reset password menggunakan Laravel Password Broker
        $status = Password::sendResetLink(['email' => $admin->email]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset password telah dikirim ke email Anda')
            : back()->with('error', 'Gagal mengirim link reset password');
    }

    // **Logout admin**
    public function destroy(Request $request)
    {
        Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');
}
}
