@extends('layouts.admin')

@section('content')

<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 leading-tight">
        Izin Usaha Kawasan (IUK)
    </h2>

   <a href="{{ route('admin.iuk.create') }}"
class="
inline-flex
items-center
justify-center
gap-1
bg-blue-600
hover:bg-blue-700
text-white
text-xs
px-2.5
py-1.5
rounded-md
shadow
w-auto
self-start
transition
duration-200
">
    <i class="fas fa-plus"></i>
    Tambah Data
</a>
</div>
        {{-- MOBILE --}}
<div class="block md:hidden space-y-4">

@forelse($layanans as $layanan)

<div class="bg-white rounded-xl shadow p-4">

    <img src="{{ asset('images/'.$layanan->image) }}"
         class="w-full h-44 object-cover rounded-lg mb-4">

    <h3 class="text-lg font-bold text-gray-800">
        {{ $layanan->nama }}
    </h3>

    <p class="text-gray-600 text-sm mt-2">
        {{ Str::limit($layanan->deskripsi,120) }}
    </p>

    <div class="flex gap-2 mt-4">

        <a href="{{ route('admin.iuk.edit',$layanan->id) }}"
           class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white py-2 rounded-lg text-sm">

            <i class="fas fa-edit mr-1"></i>
            Edit

        </a>

        <form action="{{ route('admin.iuk.destroy',$layanan->id) }}"
              method="POST"
              class="flex-1">

            @csrf
            @method('DELETE')

            <button
                onclick="return confirm('Yakin ingin menghapus data ini?')"
                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg text-sm">

                <i class="fas fa-trash-alt mr-1"></i>
                Hapus

            </button>

        </form>

    </div>

</div>

@empty

<div class="bg-white rounded-xl p-6 text-center text-gray-500">
Belum ada data IUK
</div>

@endforelse
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

<div class="hidden md:block bg-white rounded-xl shadow-md">

    <div class="w-full overflow-x-auto bg-white rounded-xl">

        <table class="w-full table-fixed text-sm">

            <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="w-[5%] px-4 py-3 text-center">No</th>
                    <th class="w-[12%] px-4 py-3 text-center">Gambar</th>
                    <th class="w-[18%] px-4 py-3 text-left">Nama IUK</th>
                    <th class="w-[45%] px-4 py-3 text-left">Deskripsi</th>
                    <th class="w-[20%] px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($layanans as $item)

                    <tr class="border-b border-gray-400">

                        <td class="px-4 py-3 text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <img src="{{ asset('images/'.$item->image) }}"
                                 class="w-24 h-16 object-cover rounded-md mx-auto">
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $item->nama }}
                        </td>

                        <td class="px-4 py-3">
                            <p class="truncate">
                                {{ $item->deskripsi }}
                            </p>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.iuk.edit', $item->id) }}"
                                   class="bg-amber-500 hover:bg-amber-600 text-white
                                          px-3 py-2 rounded-lg text-xs whitespace-nowrap">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.iuk.destroy', $item->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="bg-red-500 hover:bg-red-600 text-white
                                                   px-3 py-2 rounded-lg text-xs whitespace-nowrap">
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>
@endsection