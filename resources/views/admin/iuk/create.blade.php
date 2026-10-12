
@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Tambah Data Izin Usaha Kawasan (IUK)
        </h2>

        <!-- Pesan Validasi Error -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.iuk.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- Nama IUK -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama IUK
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama layanan IUK"
                       required
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
                          rows="5"
                          placeholder="Masukkan deskripsi layanan"
                          required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('deskripsi') }}</textarea>

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
                          placeholder="Masukkan persyaratan dokumen, satu persyaratan pada setiap baris"
                          required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('persyaratan') }}</textarea>

                <p class="text-sm text-gray-500 mt-1">
                    Masukkan dokumen yang diperlukan untuk layanan ini.
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
                          placeholder="Masukkan tahapan layanan secara berurutan, satu tahapan pada setiap baris"
                          required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('alur_layanan') }}</textarea>

                <p class="text-sm text-gray-500 mt-1">
                    Tuliskan tahapan pelayanan dari awal hingga selesai.
                </p>

                @error('alur_layanan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
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
                    Format yang didukung: JPG, JPEG, PNG. Maksimal 2 MB.
                </p>

                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex gap-3">

                <a href="{{ route('admin.iuk.index') }}"
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
