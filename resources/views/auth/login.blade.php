@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-4">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl overflow-hidden">
    <div class="grid md:grid-cols-2 h-full">

      {{-- Kolom kiri: ilustrasi --}}
      <div class="hidden md:flex bg-white w-full h-full p-6">
        <img src="{{ asset('images/jembatan.jpeg') }}"
             alt="Ilustrasi Login" class="w-full h-full object-cover rounded-xl">
      </div>

      {{-- Kolom kanan: FORM --}}
      <div class="bg-[#0b1d63] p-8 md:p-10 flex flex-col justify-center">
        <h2 class="text-3xl font-bold text-white mb-8">Login</h2>

        {{-- Flash Notifikasi --}}
@if (session('error'))
  <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
    {{ session('error') }}
  </div>
@endif

        <form method="POST" action="{{ route('login') }}">
          @csrf

          {{-- Email --}}
          <div class="mb-4">
            <label for="email" class="sr-only">Email</label>
            <div class="flex items-center border-2 border-amber-400 bg-white rounded-lg px-3 py-2
                        focus-within:ring-2 focus-within:ring-white/60">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                   fill="currentColor" class="w-5 h-5 text-[#0b1d63]">
                <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm7 8a7 7 0 0 0-14 0 1 1 0 0 0 1 1h12a1 1 0 0 0 1-1Z"/>
              </svg>
              <input id="email" name="email" type="email" required
                     class="w-full bg-white border-0 focus:ring-0 px-3
                            placeholder-[#0b1d63]/70 text-[#0b1d63]"
                     placeholder="Email">
            </div>
          </div>

          {{-- Password + ikon mata --}}
          <div class="mb-5">
            <label for="password" class="sr-only">Password</label>
            <div class="flex items-center border-2 border-amber-400 bg-white rounded-lg px-3 py-2
                        focus-within:ring-2 focus-within:ring-white/60 relative">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                   fill="currentColor" class="w-5 h-5 text-[#0b1d63]">
                <path d="M17 10h-1V7a4 4 0 0 0-8 0v3H7a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-8a1 1 0 0 0-1-1Zm-7-3a2 2 0 1 1 4 0v3h-4Z"/>
              </svg>
              <input id="password" name="password" type="password" required
                     class="w-full bg-white border-0 focus:ring-0 px-3
                            placeholder-[#0b1d63]/70 text-[#0b1d63]"
                     placeholder="Password">
              
              {{-- Tombol ikon mata --}}
              <button type="button" id="togglePassword"
                      class="absolute right-3 text-[#0b1d63] hover:text-amber-500 focus:outline-none">
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.03-10-9 0-1.184.23-2.313.652-3.351M9.878 9.88a3 3 0 104.243 4.242M15.536 8.464A9.969 9.969 0 0122 10c0 4.97-4.477 9-10 9-.883 0-1.735-.118-2.54-.34M3 3l18 18"/>
                </svg>
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" class="w-5 h-5 hidden">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </button>
            </div>
          </div>

          {{-- Ingat saya + Lupa password --}}
          <div class="flex items-center justify-between text-sm text-white mb-6">
            <label class="inline-flex items-center gap-2">
              <input type="checkbox" name="remember" class="rounded">
              <span>Ingat saya</span>
            </label>
            <a href="{{ route('password.request') }}" >
              Lupa password?
            </a>
          </div>

          {{-- Tombol Masuk --}}
          <button type="submit"
                  class="w-full bg-white text-[#0b1d63] font-semibold py-2.5 rounded-lg
                         hover:bg-gray-300 transition">
            Masuk
          </button>

          {{-- Link Sign Up --}}
          <p class="mt-4 text-sm text-white/80 text-center">
            Belum punya akun?
            <a href="{{ route('register') }}" >Register</a>
          </p>

        </form>
      </div>
    </div>
  </div>
</div>

{{-- Script untuk toggle password --}}
<script>
document.getElementById('togglePassword').addEventListener('click', function() {
  const password = document.getElementById('password');
  const eyeOpen = document.getElementById('eyeOpen');
  const eyeClosed = document.getElementById('eyeClosed');
  
  if (password.type === 'password') {
    password.type = 'text';
    eyeOpen.classList.remove('hidden');
    eyeClosed.classList.add('hidden');
  } else {
    password.type = 'password';
    eyeOpen.classList.add('hidden');
    eyeClosed.classList.remove('hidden');
  }
});
</script>
@endsection
