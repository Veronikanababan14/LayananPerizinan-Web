@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        Sektor Perizinan
    </h2>

    <a href="{{ route('admin.perizinan.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 text-sm rounded-lg shadow transition duration-200 hover:scale-105">
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
                    <th class="px-4 py-3 text-left">Nama Sektor Perizinan</th>
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($perizinans as $perizinan)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-3 text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 text-center">

                        @if($perizinan->image)
                            <img src="{{ asset('images/'.$perizinan->image) }}"
                                 class="w-24 h-16 object-cover rounded mx-auto">
                        @else
                            <span class="text-gray-400">Tidak ada gambar</span>
                        @endif

                    </td>

                    <td class="px-4 py-3 font-semibold">
                        {{ $perizinan->nama }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ Str::limit($perizinan->deskripsi, 80) }}
                    </td>

                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

    <a href="{{ route('admin.perizinan.edit', $perizinan->id) }}"
       class="bg-amber-500 hover:bg-amber-600 text-white px-2 py-1 rounded-md text-sm inline-flex items-center gap-1 transition duration-200 hover:scale-105">
        <i class="fas fa-edit"></i>
        Edit
    </a>

    <form action="{{ route('admin.perizinan.destroy', $perizinan->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus data ini?')">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md text-sm inline-flex items-center gap-1 transition duration-200 hover:scale-105">
            <i class="fas fa-trash-alt"></i>
            Hapus
        </button>

    </form>

</div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        Belum ada data Sektor Perizinan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection