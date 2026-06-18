@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Edit Data Sektor Perizinan
        </h2>

        <form action="{{ route('admin.perizinan.update', $perizinan->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Sektor Perizinan
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama', $perizinan->nama) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>

                <textarea name="deskripsi"
                          rows="5"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('deskripsi', $perizinan->deskripsi) }}</textarea>
            </div>

            <!-- Gambar Lama -->
            @if($perizinan->image)
            <div class="mb-4">

                <img src="{{ asset('images/'.$perizinan->image) }}"
                     class="w-64 rounded-lg border shadow">
            </div>
            @endif

            <!-- Upload Gambar Baru -->
                    <!-- Ganti Gambar -->
<div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Ganti Gambar
    </label>

    <input type="file"
           name="image"
           id="image"
           class="hidden">

    <label for="image"
           class="inline-block cursor-pointer bg-blue-600 text-white px-3 py-1.5 text-sm rounded-lg hover:bg-blue-700">
        Pilih Gambar
    </label>

    <span id="file-name" class="ml-3 text-sm text-gray-500">
        Belum ada file dipilih
    </span>
</div>

<script>
document.getElementById('image').addEventListener('change', function() {
    document.getElementById('file-name').textContent =
        this.files[0]?.name || 'Belum ada file dipilih';
});
</script>

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

            </div>

        </form>

    </div>

</div>

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
        allowOutsideClick: false
    });

    setTimeout(function() {
        window.location.href = "{{ route('admin.perizinan.index') }}";
    }, 3000);

});
</script>
@endif
@endsection