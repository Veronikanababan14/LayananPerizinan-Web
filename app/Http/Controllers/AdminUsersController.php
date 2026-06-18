<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {
        // Ambil semua user
        $users = User::all();

        // Kirim data ke view
        return view('admin.users', compact('users'));
    }
}
