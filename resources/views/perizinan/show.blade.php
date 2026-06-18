@extends('layouts.app')

@section('content')
<div class="p-8 bg-slate-100 min-h-screen flex justify-center items-center">
    <div class="max-w-5xl w-full bg-blue p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-black text-left">{{ $perizinan->nama }}</h1>

        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Deskripsi di sebelah kiri -->
            <div class="flex-1 text-gray-700 leading-relaxed text-justify whitespace-pre-line">
                {{ $perizinan->deskripsi }}
            </div>

            <!-- Gambar di sebelah kanan -->
            <div class="flex-shrink-0 w-full md:w-1/3">

    @if($perizinan->image)
        <img src="{{ asset('images/'.$perizinan->image) }}"
             alt="{{ $perizinan->nama }}"
             class="w-full h-64 object-cover rounded-lg shadow-md">
    @else
        <img src="{{ asset('images/default.png') }}"
             alt="Default Image"
             class="w-full h-64 object-cover rounded-lg shadow-md">
    @endif

</div>
        </div>

        <!-- Tombol kembali di bawah kiri -->
        <div class="mt-8 flex justify-start">
            <a href="{{ route('beranda') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
               ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
