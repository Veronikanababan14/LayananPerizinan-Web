<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // di bagian atas file jika belum ada
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        // data bisa ambil dari database (misalnya jumlah user, jumlah layanan)
        return view('admin.login');
    }

    public function editProfile()
{
    $admin = Auth::user(); // Ambil data admin yang sedang login
    return view('admin.profile.edit', compact('admin'));
}

public function updateProfile(Request $request)
{
    $admin = auth()->user(); // atau model Admin kamu

    $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

    $admin->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('admin.profile.edit')->with('success', 'Profile berhasil diperbarui!');
}

public function showChangePasswordForm()
{
    // tampilkan view change password (buat file view di resources/views/admin/profile/change-password.blade.php)
    return view('admin.profile.change-password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $admin = Auth()->user();

    if (!\Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah']);
    }

    $admin->password = bcrypt($request->new_password);
    $admin->save();

    return redirect()->route('admin.profile.password.form')->with('success', 'Password berhasil diperbarui!');
}

public function endorsement()
{
    return view('admin.iuk.endorsement');
}

public function pengajuan()
{
    return view('admin.iuk.pengajuan');
}

public function persiapanLingkungan()
{
    return view('admin.iuk.persiapan-lingkungan');
}

public function izinLingkungan()
{
    return view('admin.iuk.izin_lingkungan');
}




}
