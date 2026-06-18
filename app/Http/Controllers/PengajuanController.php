<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    // TAMPIL FORM
    public function create()
    {
        $layanan = Layanan::all();
        return redirect()->route('dashboard.user');
    }

    // SIMPAN PENGAJUAN
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id'   => 'required|exists:layanans,id',
            'nama_lengkap' => 'required|string|max:255',
            'nik'          => 'required|digits:16',
            'no_telepon'   => 'required|string|max:15',
            'alamat'       => 'required|string',
            'keterangan'   => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $nomorUrut = str_pad(Pengajuan::count() + 1, 3, '0', STR_PAD_LEFT);
        $noPermohonan = 'PERIZINAN/' . date('Y') . '/' . $nomorUrut;

        $filePath = null;
        if ($request->hasFile('file_dokumen')) {
            $filePath = $request->file('file_dokumen')->store('dokumen', 'public');
        }

        Pengajuan::create([
            'user_id'       => Auth::id(),
            'layanan_id'    => $request->layanan_id,
            'no_permohonan' => $noPermohonan,
            'nama_lengkap'  => $request->nama_lengkap,
            'nik'           => $request->nik,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat,
            'keterangan'    => $request->keterangan,
            'file_dokumen'  => $filePath,
            'status'        => 'menunggu',
        ]);

        return redirect()->back()
            ->with('success', true)
            ->with('no_permohonan', $noPermohonan);
    }

    // UPLOAD ULANG DOKUMEN SAAT DITOLAK
    public function uploadUlang(Request $request, $id)
    {
        $request->validate([
            'file_dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $pengajuan = Pengajuan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('file_dokumen')) {
            $filePath = $request->file('file_dokumen')
                ->store('dokumen_pengajuan', 'public');

            $pengajuan->update([
                'file_dokumen'  => $filePath,
                'status'        => 'menunggu',
                'catatan_admin' => null,
            ]);
        }

        return redirect()->back()
            ->with('success', 'Dokumen berhasil diupload ulang.');
    }
}