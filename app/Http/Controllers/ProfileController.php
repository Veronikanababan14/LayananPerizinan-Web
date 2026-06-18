<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan halaman pengaturan profile
    public function settings()
    {
        return view('profile.settings'); // pastikan ada file view resources/views/profile/settings.blade.php
    }

    // Update data profile user
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

       $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('dashboard.user')->with('profile_success', 'Profil berhasil diperbarui!');
}
public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Password lama tidak sesuai.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('password_success', 'Password berhasil diperbarui!');

}
}