@extends('layouts.app')

@section('content')
<section class="pt-20 pb-12 bg-slate-100">
  <div class="max-w-5xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-blue-700 mb-4">{{ $layanan->nama }}</h1>
    <p class="text-gray-600 mb-6">{{ $layanan->deskripsi }}</p>

    <div class="text-center mb-6">
      <img src="{{ asset('images/layanan_' . $layanan->id . '.png') }}" 
           alt="{{ $layanan->nama }}" 
           class="mx-auto w-full max-w-md rounded shadow">
    </div>

    <div class="mb-6">
      <!-- Geser lebih jauh ke kanan -->
      <h2 class="text-xl font-semibold text-orange-500 mb-2 pl-16">Detail Proses Layanan</h2>
      <p class="text-gray-700 pl-16">{!! nl2br(e($layanan->detail_proses)) !!}</p>
    </div>

   
  </div>
</section>
@endsection
