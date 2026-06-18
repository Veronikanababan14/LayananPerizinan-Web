@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        Izin Usaha Kawasan (IUK)
    </h2>

    <a href="{{ route('admin.iuk.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-2.5 py-1 rounded-lg shadow">
        + Tambah Data
    </a>
</div>

@if(session('success'))
<div id="success-alert"
     class="bg-green-100 border border-green-500 text-green-700 p-4 mb-4 rounded">
    {{ session('success') }}
</div>

<script>
setTimeout(function () {
    let alertBox = document.getElementById('success-alert');

    if(alertBox){
        alertBox.style.transition = "0.5s";
        alertBox.style.opacity = "0";
        
        setTimeout(() => {
            alertBox.remove();
        }, 500);
    }
}, 2000);
</script>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full border-collapse">

            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-center">Gambar</th>
                    <th class="px-4 py-3 text-left">Nama IUK</th>
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($layanans as $layanan)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-3 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 text-center">

                        @if($layanan->image)
                            <img src="{{ asset('images/'.$layanan->image) }}"
                                 class="w-24 h-16 object-cover rounded mx-auto">
                        @else
                            <span class="text-gray-400">Tidak ada gambar</span>
                        @endif

                    </td>

                    <td class="px-4 py-3 font-semibold">
                        {{ $layanan->nama }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ Str::limit($layanan->deskripsi, 80) }}
                    </td>

                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.iuk.edit', $layanan->id) }}"
   class="bg-amber-500 hover:bg-amber-600 text-white px-2 py-0.5 rounded-md text-xs inline-flex items-center gap-1">
    <i class="fas fa-edit"></i> Edit
</a>

<form action="{{ route('admin.iuk.destroy', $layanan->id) }}"
      method="POST"
      class="inline">
    @csrf
    @method('DELETE')

    <button type="submit"
            class="bg-red-500 hover:bg-red-600 text-white px-2 py-0.5 rounded-md text-sm inline-flex items-center gap-1">
        <i class="fas fa-trash-alt"></i> Hapus
    </button>
</form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        Belum ada data IUK
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection