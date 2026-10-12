```blade
@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Tambah Data Sektor Perizinan
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.perizinan.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- Nama Sektor Perizinan -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Sektor Perizinan
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama layanan Sektor Perizinan"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>

                <textarea name="deskripsi"
                          rows="5"
                          placeholder="Masukkan deskripsi perizinan"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Persyaratan -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Persyaratan
                </label>

                <textarea name="persyaratan"
                          rows="6"
                          placeholder="Masukkan persyaratan, satu persyaratan untuk setiap baris"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('persyaratan') }}</textarea>

                <p class="text-sm text-gray-500 mt-1">
                    Tuliskan setiap persyaratan pada baris terpisah agar mudah dibaca pada halaman detail layanan.
                </p>
            </div>

            <!-- Alur Layanan -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Alur Layanan
                </label>

                <textarea name="alur_layanan"
                          rows="6"
                          placeholder="Masukkan tahapan alur layanan, satu tahapan untuk setiap baris"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('alur_layanan') }}</textarea>

                <p class="text-sm text-gray-500 mt-1">
                    Tuliskan setiap tahapan pada baris terpisah sesuai urutan proses layanan.
                </p>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Gambar
                </label>

                <input type="file"
                       name="image"
                       accept=".jpg,.jpeg,.png"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2">

                <p class="text-sm text-gray-500 mt-1">
                    Format yang didukung: JPG, JPEG, PNG.
                </p>
            </div>

            <!-- Tombol -->
            <div class="flex gap-3">

                <a href="{{ route('admin.perizinan.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                    Batal
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

</div>

@endsection