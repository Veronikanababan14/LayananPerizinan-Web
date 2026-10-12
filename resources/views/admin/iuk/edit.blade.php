
@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Edit Data IUK
        </h2>

        <form action="{{ route('admin.iuk.update', $layanan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama IUK
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama', $layanan->nama) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>

                <textarea name="deskripsi"
                          rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>

                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Persyaratan Dokumen -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Persyaratan Dokumen
                </label>

                <textarea name="persyaratan"
                          rows="5"
                          placeholder="Masukkan persyaratan dokumen. Pisahkan setiap persyaratan dengan baris baru."
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('persyaratan', $layanan->persyaratan) }}</textarea>

                <p class="text-xs text-gray-500 mt-1">
                    Masukkan daftar dokumen yang diperlukan untuk layanan ini.
                </p>

                @error('persyaratan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alur Layanan -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Alur Layanan
                </label>

                <textarea name="alur_layanan"
                          rows="6"
                          placeholder="Tuliskan tahapan layanan, satu tahap pada setiap baris."
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('alur_layanan', $layanan->alur_layanan) }}</textarea>

                <p class="text-xs text-gray-500 mt-1">
                    Tuliskan tahapan pelayanan secara berurutan.
                </p>

                @error('alur_layanan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar Lama -->
            @if($layanan->image)
                <div class="mb-4">
                    <img src="{{ asset('images/'.$layanan->image) }}"
                         alt="Gambar {{ $layanan->nama }}"
                         class="w-64 rounded-lg border shadow">
                </div>
            @endif

            <!-- Ganti Gambar -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Ganti Gambar
                </label>

                <input type="file"
                       name="image"
                       id="image"
                       accept="image/*"
                       class="hidden">

                <label for="image"
                       class="inline-block cursor-pointer bg-blue-600 text-white px-3 py-1.5 text-sm rounded-lg hover:bg-blue-700">
                    Pilih Gambar
                </label>

                <span id="file-name" class="ml-3 text-sm text-gray-500">
                    Belum ada file dipilih
                </span>

                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex gap-2">

                <a href="{{ route('admin.iuk.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-1.5 text-sm rounded-lg">
                    Batal
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 text-sm rounded-lg">
                    Update Data
                </button>

            </div>

        </form>

    </div>

</div>

<!-- Nama file gambar -->
<script>
document.getElementById('image').addEventListener('change', function() {
    document.getElementById('file-name').textContent =
        this.files[0]?.name || 'Belum ada file dipilih';
});
</script>

<!-- Notifikasi Berhasil -->
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Diperbarui',
            html: `
                <div style="text-align:center">
                    <p style="margin-bottom:8px;">
                        Data Izin Usaha Kawasan beserta informasi
                        layanan berhasil diperbarui.
                    </p>

                    <small style="color:#6b7280;">
                        Anda akan diarahkan kembali ke halaman
                        daftar Izin Usaha Kawasan.
                    </small>
                </div>
            `,
            confirmButtonText: 'OK',
            confirmButtonColor: '#2563eb',
            timer: 5000,
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(() => {
            window.location.href = "{{ route('admin.iuk.index') }}";
        });
    });
    </script>
@endif

@endsection
