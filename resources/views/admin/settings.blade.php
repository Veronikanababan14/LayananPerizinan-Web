@extends('layouts.admin')

@section('content')
<div class="p-4">

    <!-- Judul Halaman -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Settings</h2>

    <!-- Card Pengaturan -->
    <div class="bg-white shadow rounded-lg p-6">

        <h3 class="text-lg font-semibold mb-4 text-gray-700">Pengaturan Akun</h3>

        <form action="#" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-gray-600 font-medium mb-1">Nama Admin</label>
                <input type="text" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->name }}">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-600 font-medium mb-1">Email</label>
                <input type="email" class="w-full px-3 py-2 border rounded-lg" value="{{ Auth::user()->email }}">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-600 font-medium mb-1">Password Baru</label>
                <input type="password" class="w-full px-3 py-2 border rounded-lg" placeholder="••••••••">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700">
                Simpan Perubahan
            </button>

        </form>
    </div>

</div>
@endsection
