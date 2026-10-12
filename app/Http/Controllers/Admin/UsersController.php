<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $users = User::where('role', '!=', 'admin')
    ->when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
        });
    })
    ->orderBy('created_at', 'desc')
    ->get();

    return view('admin.users.index', compact('users'));
}
}