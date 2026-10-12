<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'perizinan_id',
        'no_permohonan',
        'nama_lengkap',
        'nik',
        'no_telepon',
        'alamat',
        'keterangan',
        'file_dokumen',
        'status',
        'catatan_admin',
        'is_perbaikan',
        'dibaca_admin',
    ];

    protected $casts = [
        'is_perbaikan' => 'boolean',
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI KE LAYANAN
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    // RELASI KE PERIZINAN
    public function perizinan()
    {
        return $this->belongsTo(
            \App\Models\Perizinan::class,
            'perizinan_id',
            'id'
        );
    }

    // RELASI KE DOKUMEN PENGAJUAN
    public function dokumenPengajuan()
    {
        return $this->hasMany(DokumenPengajuan::class, 'pengajuan_id');
    }
}
