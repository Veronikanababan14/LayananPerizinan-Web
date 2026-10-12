<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Notifikasi;
use App\Models\AktivitasAdmin;

class AdminPengajuanController extends Controller
{
    // LIST SEMUA PENGAJUAN
    public function index()
    {
        $pengajuan = Pengajuan::with(['user', 'layanan'])
            ->latest()
            ->get();

        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    // UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,disetujui,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->status = $request->status;
        $pengajuan->catatan_admin = $request->catatan_admin;
        $pengajuan->save();

        $pesanMap = [
            'diproses'  => 'Permohonan anda sedang diproses oleh admin.',
            'disetujui' => 'Selamat! Permohonan anda telah disetujui.',
            'ditolak'   => 'Permohonan anda ditolak. Silakan cek kembali persyaratan.',
        ];

        $judulMap = [
            'diproses'  => 'Permohonan Sedang Diproses',
            'disetujui' => 'Permohonan Disetujui ✅',
            'ditolak'   => 'Permohonan Ditolak ❌',
        ];

        $tipeMap = [
            'diproses'  => 'info',
            'disetujui' => 'success',
            'ditolak'   => 'warning',
        ];

        // Simpan notifikasi user
        Notifikasi::create([
            'user_id' => $pengajuan->user_id,
            'judul'   => $judulMap[$request->status],
            'pesan'   => $pesanMap[$request->status] .
                         ' (No: ' . $pengajuan->no_permohonan . ')',
            'tipe'    => $tipeMap[$request->status],
            'dibaca'  => false,
        ]);

        // Simpan aktivitas admin
        AktivitasAdmin::create([
            'aktivitas' => 'Status pengajuan ' .
                ($pengajuan->no_permohonan ?? '-') .
                ' telah diperbarui menjadi ' .
                ucfirst($request->status),

            'status' => $request->status,
        ]);
$pesanAdmin = [
    'diproses'  => 'Status permohonan berhasil diperbarui.',
    'disetujui' => 'Permohonan berhasil disetujui.',
    'ditolak'   => 'Permohonan berhasil ditolak.',
];
        return redirect()
    ->route('admin.pengajuan.index')
    ->with('success', $pesanAdmin[$request->status]);
    }

    // BACA NOTIFIKASI ADMIN
    public function bacaNotifikasi($id)
    {
        $item = Pengajuan::findOrFail($id);

        $item->dibaca_admin = true;
        $item->save();

        return redirect()->route('admin.pengajuan.index');
    }
}