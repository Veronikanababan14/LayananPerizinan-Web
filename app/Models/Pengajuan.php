<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'no_permohonan',
        'nama_lengkap',
        'nik',
        'no_telepon',
        'alamat',
        'keterangan',
        'file_dokumen',
        'status',
        'catatan_admin',
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
}