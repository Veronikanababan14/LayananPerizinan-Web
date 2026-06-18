@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Profil Admin</h2>
    
    {{-- ✅ Flash message sukses --}}
    @if (session('success'))
        <div id="success-alert"
            class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-md flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>

        <script>
            // Auto redirect ke dashboard setelah 2 detik
            setTimeout(() => {
                window.location.href = "{{ route('admin.dashboard') }}";
            }, 2000);
        </script>
    @endif

    {{-- ✅ Form edit profil --}}
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="name" value="{{ $admin->name }}"
                   class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ $admin->email }}"
                   class="w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="flex items-center gap-4">
    {{-- Tombol Simpan --}}
    <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-1/2 font-semibold transition duration-200 cursor-pointer">
        Simpan
    </button>

    {{-- Tombol Batal --}}
    <a href="{{ route('admin.dashboard') }}"
        class="text-center bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg w-1/2 font-semibold transition duration-200 cursor-pointer">
        Batal
    </a>
</div>

    </form>
</div>
@endsection
