@extends('layouts.app')

@section('content')
<div class="p-8 bg-gray-100 min-h-screen">
    <h2 class="text-2xl font-bold mb-4">Hasil Pencarian Perizinan untuk "{{ $query }}"</h2>

    @if($perizinan->isEmpty())
        <p>Tidak ada hasil ditemukan.</p>
    @else
        <ul>
            @foreach($perizinan as $perizinan)
                <li><a href="{{ route('perizinan.show', $perizinan->id) }}">{{ $perizinan->nama }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
