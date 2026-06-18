<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'perizinans';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nama',
        'deskripsi',
        'image',
        'tanggal',
    ];

    // Jika kamu punya kolom timestamps (created_at, updated_at)
    public $timestamps = true;
}
