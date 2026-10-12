<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Layanan;
use App\Models\DokumenPengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    // TAMPIL FORM
    public function create()
    {
        $layanan = Layanan::all();

        return redirect()->route('dashboard.user');
    }

    // SIMPAN PENGAJUAN BARU
    public function store(Request $request)
    {
        // Mendukung input file tunggal maupun beberapa file
        $files = $request->file('file_dokumen');

        if ($files && !is_array($files)) {
            $request->files->set('file_dokumen', [$files]);
        }

        $request->validate([
            'jenis_pengajuan' => 'required',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|digits:16',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',

            'file_dokumen' => 'nullable|array',
            'file_dokumen.*' =>
                'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $nomorUrut = str_pad(
            Pengajuan::count() + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

        $noPermohonan =
            'PERIZINAN/' . date('Y') . '/' . $nomorUrut;

        $layananId = null;
        $perizinanId = null;

        if (str_starts_with(
            $request->jenis_pengajuan,
            'layanan_'
        )) {
            $layananId = str_replace(
                'layanan_',
                '',
                $request->jenis_pengajuan
            );
        } elseif (str_starts_with(
            $request->jenis_pengajuan,
            'perizinan_'
        )) {
            $perizinanId = str_replace(
                'perizinan_',
                '',
                $request->jenis_pengajuan
            );
        }

        $pengajuan = Pengajuan::create([
            'user_id' => Auth::id(),
            'layanan_id' => $layananId,
            'perizinan_id' => $perizinanId,
            'no_permohonan' => $noPermohonan,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'file_dokumen' => null,
            'status' => 'diproses',
            'is_perbaikan' => false,
        ]);

        $filePaths = [];

        foreach ($request->file('file_dokumen', []) as $file) {
            $path = $file->store('dokumen', 'public');

            DokumenPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'nama_dokumen' => $file->getClientOriginalName(),
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
                'tipe_file' => $file->getClientMimeType(),
                'ukuran_file' => $file->getSize(),
            ]);

            $filePaths[] = $path;
        }

        // Pertahankan kolom file_dokumen untuk kompatibilitas kode lama
        if (!empty($filePaths)) {
            $pengajuan->update([
                'file_dokumen' => $filePaths[0],
            ]);
        }

        return redirect()->back()->with([
            'success' => true,
            'success_type' => 'permohonan_baru',
            'no_permohonan' => $noPermohonan,
        ]);
    }

    // UPLOAD ULANG DOKUMEN SAAT PERLU PERBAIKAN
    public function uploadUlang(Request $request, $id)
    {
        // Mendukung input file tunggal maupun beberapa file
        $files = $request->file('file_dokumen');

        if ($files && !is_array($files)) {
            $request->files->set('file_dokumen', [$files]);
        }

        $request->validate([
            'file_dokumen' => 'required|array|min:1',
            'file_dokumen.*' =>
                'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $pengajuan = Pengajuan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $filePaths = [];

        foreach ($request->file('file_dokumen', []) as $file) {
            $path = $file->store(
                'dokumen_pengajuan',
                'public'
            );

            DokumenPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'nama_dokumen' => $file->getClientOriginalName(),
                'nama_file' => $file->getClientOriginalName(),
                'path_file' => $path,
                'tipe_file' => $file->getClientMimeType(),
                'ukuran_file' => $file->getSize(),
            ]);

            $filePaths[] = $path;
        }

        // Simpan file pertama pada kolom lama
        $pengajuan->update([
            'file_dokumen' => $filePaths[0],
            'status' => 'diproses',
            'catatan_admin' => null,
            'is_perbaikan' => true,
            'dibaca_admin' => false,
        ]);

        return redirect()->back()->with([
            'success' => true,
            'success_type' => 'upload_ulang',
            'no_permohonan' => $pengajuan->no_permohonan,
        ]);
    }
}
