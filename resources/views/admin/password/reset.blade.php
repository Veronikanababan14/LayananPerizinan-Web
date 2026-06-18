@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h2 class="text-xl font-bold mb-4 text-center">Reset Password Admin</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 border border-red-400 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password Baru</label>
            <input type="password" name="password" class="w-full border p-2 rounded @error('password') border-red-500 @enderror" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">
            Reset Password
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('admin.login') }}" class="text-blue-600 hover:underline text-sm">
            Kembali ke Login
        </a>
    </div>
</div>
@endsection
