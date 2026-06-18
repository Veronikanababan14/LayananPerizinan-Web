@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h2 class="text-xl font-bold mb-4 text-center">Lupa Password Admin</h2>

    <!-- Tampilkan pesan sukses / error -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-400 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 border border-red-400 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">
            Kirim Link Reset Password
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('admin.login') }}" class="text-blue-600 hover:underline text-sm">
            Kembali ke Login
        </a>
    </div>
</div>
@endsection
