@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    @php
        // menerima array atau object
        if(isset($perizinan) && is_array($perizinan)) {
            $title = $perizinan['title'] ?? null;
            $image = $perizinan['image'] ?? null;
            $video = $perizinan['video'] ?? null;
            $desc  = $perizinan['description'] ?? $perizinan['deskripsi'] ?? null;
        } elseif(isset($perizinan) && is_object($perizinan)) {
            $title = $perizinan->nama ?? $perizinan->title ?? null;
            $image = $perizinan->image ?? null;
            $video = $perizinan->video ?? null;
            $desc  = $perizinan->deskripsi ?? $perizinan->description ?? null;
        } else {
            $title = null;
            $image = null;
            $video = null;
            $desc = null;
        }
    @endphp

    @if(!$title)
        <div class="text-center text-gray-600">
            <p>Data perizinan tidak tersedia.</p>
            <a href="{{ route('perizinan.index') }}" class="text-blue-600 hover:underline">Kembali ke daftar</a>
        </div>
    @else
        <h1 class="text-3xl font-bold text-blue-700 mb-4">{{ $title }}</h1>

        @if($image)
            <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full max-w-md mx-auto mb-4 rounded">
        @endif

        @if($video)
            <div class="mb-4">
                <iframe src="{{ $video }}" title="Video {{ $title }}" frameborder="0" allowfullscreen class="w-full h-64"></iframe>
            </div>
        @endif

        @if($desc)
            <p class="text-gray-700 mb-4">{!! nl2br(e($desc)) !!}</p>
        @endif

        <a href="{{ route('perizinan.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar</a>
    @endif
</div>
@endsection
