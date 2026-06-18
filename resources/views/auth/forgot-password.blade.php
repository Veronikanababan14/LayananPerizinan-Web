@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Reset Password</h2>

        @if(session('status'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" required
                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Masukkan email anda">

            <button type="submit" class="w-full bg-blue-700 text-white font-bold py-2 rounded hover:bg-blue-800">
                Kirim Link Reset Password
            </button>
        </form>
        @if (session('status'))
    <div class="text-green-600">{{ session('status') }}</div>
@endif

@error('email')
    <div class="text-red-600">{{ $message }}</div>
@enderror
    </div>
</div>
@endsection
