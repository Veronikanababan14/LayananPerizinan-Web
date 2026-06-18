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
            'menunggu'  => 'Pengajuan anda sedang menunggu diproses oleh admin.',
            'diproses'  => 'Pengajuan anda sedang diproses oleh admin.',
            'disetujui' => 'Selamat! Pengajuan anda telah disetujui.',
            'ditolak'   => 'Pengajuan anda ditolak. Silakan cek kembali persyaratan.',
        ];

        $judulMap = [
            'menunggu'  => 'Pengajuan Menunggu Diproses',
            'diproses'  => 'Pengajuan Sedang Diproses',
            'disetujui' => 'Pengajuan Disetujui ✅',
            'ditolak'   => 'Pengajuan Ditolak ❌',
        ];

        $tipeMap = [
            'menunggu'  => 'info',
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

        return redirect()
            ->route('admin.pengajuan.index')
            ->with('success', 'Status pengajuan berhasil diperbarui!');
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