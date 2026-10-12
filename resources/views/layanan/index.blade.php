@extends('layouts.app')

@section('content')
<div class="p-8 bg-blue-100 min-h-screen">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">Daftar Layanan</h1>

        {{-- Tampilkan semua layanan --}}
        @if($layanans->isEmpty())
            <p class="text-gray-600">Belum ada layanan yang tersedia.</p>
        @else
            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
                @foreach ($layanans as $layanan)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl shadow-sm hover:shadow-lg transition p-4">
                        {{-- Gambar layanan --}}
                        @php
                            $imagePath = $layanan->image 
                                ? 'storage/' . $layanan->image 
                                : 'images/layanan_' . $layanan->id . '.png';
                        @endphp

                        @if(file_exists(public_path($imagePath)))
                            <img src="{{ asset($imagePath) }}" 
                                 alt="{{ $layanan->nama }}" 
                                 class="rounded-lg h-40 w-full object-cover mb-3">
                        @else
                            <div class="h-40 w-full bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">
                                Gambar tidak tersedia
                            </div>
                        @endif

                        {{-- Nama layanan --}}
                        <h3 class="text-lg font-bold text-black mb-2">{{ $layanan->nama }}</h3>

                        {{-- Deskripsi singkat --}}
                        <p class="text-gray-600 text-sm mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags($layanan->deskripsi), 100) }}
                        </p>

                        {{-- Tombol menuju halaman detail --}}
                        <a href="{{ route('layanan.show', $layanan->id) }}" 
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        
    </div>
</div>
@endsection
