<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // pastikan sesuai nama tabel (biasanya jamak: kategoris)
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'image',
        'tanggal',
    ];
}
