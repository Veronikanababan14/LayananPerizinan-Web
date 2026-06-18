@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-50 min-h-screen">
    <h2 class="text-2xl font-bold mb-6">Hasil Pencarian</h2>

    @php
        use Illuminate\Support\Str;

        $results = $layanans ?? collect();
        $query = $query ?? request('q') ?? '';
    @endphp

    @if($results->isEmpty())
        <p class="text-gray-600">
            Tidak ditemukan hasil untuk pencarian:
            <strong>{{ $query }}</strong>
        </p>
    @else
        {{-- Jika hasilnya hanya 1, langsung redirect ke halaman detail --}}
        @if($results->count() === 1)
            <script>
                window.location.href = "{{ route('layanan.show', $results->first()->id) }}";
            </script>
        @else
            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
                @foreach ($results as $layanan)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                        @if($layanan->image)
                            <img src="{{ asset('storage/' . $layanan->image) }}" 
                                alt="{{ $layanan->nama }}" 
                                class="rounded-xl h-40 w-full object-cover mb-3">
                        @endif

                        <h3 class="text-lg font-semibold mb-2">{{ $layanan->nama }}</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($layanan->deskripsi, 100) }}
                        </p>

                        <a href="{{ route('layanan.show', $layanan->id) }}" 
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection
