@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Ubah Password</h2>

    {{-- ✅ Flash message sukses --}}
    @if (session('success'))
        <div id="success-alert"
            class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-md">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                window.location.href = "{{ route('admin.dashboard') }}";
            }, 1000);
        </script>
    @endif

    {{-- ✅ Error message --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow-md">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Form Ubah Password --}}
    <form action="{{ route('admin.profile.password.update') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Password Lama --}}
        <div>
            <label for="current_password" class="block text-gray-700 font-medium mb-1">Password Lama</label>
            <div class="relative">
                <input type="password" id="current_password" name="current_password"
                    class="w-full border rounded-lg p-2 pr-10 focus:ring-blue-500 focus:border-blue-500" required>
                <button type="button" onclick="togglePassword('current_password', this)"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Password Baru --}}
        <div>
            <label for="new_password" class="block text-gray-700 font-medium mb-1">Password Baru</label>
            <div class="relative">
                <input type="password" id="new_password" name="new_password"
                    class="w-full border rounded-lg p-2 pr-10 focus:ring-blue-500 focus:border-blue-500" required>
                <button type="button" onclick="togglePassword('new_password', this)"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label for="new_password_confirmation" class="block text-gray-700 font-medium mb-1">Konfirmasi Password Baru</label>
            <div class="relative">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    class="w-full border rounded-lg p-2 pr-10 focus:ring-blue-500 focus:border-blue-500" required>
                <button type="button" onclick="togglePassword('new_password_confirmation', this)"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ✅ Tombol Aksi --}}
        <div class="flex justify-between space-x-3">
            {{-- Tombol Simpan --}}
            <button type="submit"
                class="w-1/2 text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-200 cursor-pointer">
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

{{-- ✅ Script toggle password dengan transisi warna aktif hanya saat diklik --}}
<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);

    const isVisible = input.type === 'text';
    input.type = isVisible ? 'password' : 'text';

    // Transisi warna aktif hanya saat password terlihat
    if (!isVisible) {
        btn.classList.add('text-blue-500');
        btn.classList.remove('text-gray-500');
    } else {
        btn.classList.add('text-gray-500');
        btn.classList.remove('text-blue-500');
    }
}
</script>
@endsection
