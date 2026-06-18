<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();

            // RELASI
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade');

            // NOMOR PERMOHONAN (auto generate)
            $table->string('no_permohonan')->unique();

            // DATA PEMOHON
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('no_telepon', 15);
            $table->text('alamat');
            $table->text('keterangan')->nullable();

            // DOKUMEN
            $table->string('file_dokumen')->nullable(); // path file upload

            // STATUS
            $table->enum('status', ['menunggu', 'diproses', 'disetujui', 'ditolak'])
                  ->default('menunggu');

            $table->text('catatan_admin')->nullable(); // alasan ditolak dll

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};