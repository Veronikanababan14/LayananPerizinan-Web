<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Perizinan;
use App\Models\Kategori;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use App\Models\AktivitasAdmin;

class AdminDashboardController extends Controller
{
    public function index()
    {
      $total_iuk = Layanan::count();

    $total_sektor_perizinan = Perizinan::count();

    $total_pengajuan = Pengajuan::count();

    $total_users = User::where('role', 'user')->count();

    $aktivitas_terbaru = AktivitasAdmin::latest()
            ->take(5)
            ->get();

    return view('admin.dashboard', compact(
        'total_iuk',
        'total_sektor_perizinan',
        'total_pengajuan',
        'total_users',
        'aktivitas_terbaru'
    ));  


    }
}
