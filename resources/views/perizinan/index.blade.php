@extends('layouts.app')

@section('content')
<div class="p-8 bg-blue-700 min-h-screen">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">Daftar Perizinan</h1>

        {{-- Tampilkan semua perizinan --}}
        @if($perizinans->isEmpty())
            <p class="text-gray-600">Belum ada perizinan yang tersedia.</p>
        @else
            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
                @foreach ($perizinans as $perizinan)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl shadow-sm hover:shadow-lg transition p-4">
                        {{-- Gambar perizinan --}}
                        @php
                            $imagePath = $perizinan->image 
                                ? 'storage/' . $perizinan->image 
                                : 'images/perizinan_' . $perizinan->id . '.png';
                        @endphp

                        @if(file_exists(public_path($imagePath)))
                            <img src="{{ asset($imagePath) }}" 
                                 alt="{{ $perizinan->nama_perizinan ?? $perizinan->nama }}" 
                                 class="rounded-lg h-40 w-full object-cover mb-3">
                        @else
                            <div class="h-40 w-full bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">
                                Gambar tidak tersedia
                            </div>
                        @endif

                        {{-- Nama perizinan --}}
                        <h3 class="text-lg font-bold text-black mb-2">
                            {{ $perizinan->nama_perizinan ?? $perizinan->nama }}
                        </h3>

                        {{-- Deskripsi singkat --}}
                        <p class="text-gray-600 text-sm mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags($perizinan->keterangan ?? $perizinan->deskripsi), 100) }}
                        </p>

                        {{-- Tombol ke detail --}}
                        <a href="{{ route('perizinan.show', $perizinan->id) }}" 
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Back --}}
        <div class="mt-8">
            <a href="{{ route('home') }}" 
               class="inline-block px-4 py-2 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
               ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
