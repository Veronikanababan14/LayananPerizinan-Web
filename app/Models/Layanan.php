<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    

    protected $table = 'layanans'; // nama tabel sesuai database
    protected $fillable = ['nama', 'deskripsi', 'persyaratan', 'alur_layanan', 'image', 'tanggal'];
}