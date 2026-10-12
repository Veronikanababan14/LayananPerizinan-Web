<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPengajuan extends Model
{
    protected $table = 'dokumen_pengajuans';

    protected $fillable = [
        'pengajuan_id',
        'nama_dokumen',
        'nama_file',
        'path_file',
        'tipe_file',
        'ukuran_file',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
