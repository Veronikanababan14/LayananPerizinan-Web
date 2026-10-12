<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\Notifikasi;
use App\Models\Iuk;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        $perizinan = Perizinan::all();

        $pengajuan = Pengajuan::where('user_id', Auth::id())
            ->with(['layanan', 'perizinan'])
            ->latest()
            ->get();

        $notifikasi_count = Notifikasi::where('user_id', Auth::id())
            ->where('dibaca', false)
            ->count();

        $total_pengajuan = Pengajuan::where('user_id', Auth::id())->count();

        $total_diproses = Pengajuan::where('user_id', Auth::id())
            ->where('status', 'diproses')
            ->count();

        $total_disetujui = Pengajuan::where('user_id', Auth::id())
            ->where('status', 'disetujui')
            ->count();

        $total_ditolak = Pengajuan::where('user_id', Auth::id())
            ->where('status', 'ditolak')
            ->count();

        $pengajuan_terbaru = Pengajuan::where('user_id', Auth::id())
            ->with('layanan')
            ->latest()
            ->take(3)
            ->get();

        $pengajuan_aktif = Pengajuan::where('user_id', Auth::id())
            ->with('layanan')
            ->latest()
            ->first();

        $iukList = Layanan::all();
        $perizinanList = Perizinan::all();

        return view('users.dashboard', compact(
            'layanan',
            'perizinan',
            'pengajuan',
            'notifikasi_count',
            'total_pengajuan',
            'total_diproses',
            'total_disetujui',
            'total_ditolak',
            'pengajuan_terbaru',
            'pengajuan_aktif',
            'iukList',
            'perizinanList'
            
        )); // ← hanya satu return view
    }
}