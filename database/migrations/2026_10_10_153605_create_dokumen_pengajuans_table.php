
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumen_pengajuans', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel pengajuan yang sudah ada
            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuan')
                  ->cascadeOnDelete();

            // Informasi dokumen yang diunggah
            $table->string('nama_dokumen')->nullable();
            $table->string('nama_file');
            $table->string('path_file');
            $table->string('tipe_file', 100);
            $table->unsignedBigInteger('ukuran_file');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pengajuans');
    }
};
