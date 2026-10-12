@extends('layouts.admin')

@section('title', 'Manajemen Users')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 min-h-[400px]">
   <!-- JUDUL & PENCARIAN -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <!-- JUDUL -->
    <h1 class="text-2xl font-bold text-gray-800">
        Daftar Pengguna
    </h1>

    <!-- PENCARIAN USER -->
    <form method="GET"
          action="{{ url()->current() }}"
          class="flex items-center gap-2 w-full md:w-auto">

        <div class="relative flex-1 md:w-72">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama atau email..."
                   class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm
                          outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit"
                class="px-4 py-2 bg-blue-900 text-white rounded-lg text-sm
                       hover:bg-blue-800 transition">
            Cari
        </button>

        @if(request('search'))
            <a href="{{ url()->current() }}"
               class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm
                      hover:bg-gray-200 transition text-center">
                Reset
            </a>
        @endif

    </form>

</div>

<!-- WRAPPER DENGAN BORDER FULL SAMPAI BAWAH -->
<div class="w-full overflow-x-auto border border-gray-300 rounded-lg">

        <table class="min-w-max w-full text-[10px] md:text-sm border-collapse">
            <thead class="bg-blue-900 text-white">
                <tr class="text-[10px] md:text-xs">
                    <th class="py-2 px-2 text-center border border-gray-300">No</th>
                    <th class="py-2 px-2 text-center border border-gray-300">Nama</th>
                    <th class="py-2 px-2 text-center border border-gray-300">Email</th>
                    <th class="py-2 px-2 text-center border border-gray-300">Tanggal Daftar</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
<tr class="hover:bg-gray-100 text-[10px] md:text-xs">
    <td class="py-1 px-2 text-center border border-gray-300">
        {{ $loop->iteration }}
    </td>

    <td class="py-1 px-2 text-center border border-gray-300">
        {{ $user->name }}
    </td>

    <td class="py-1 px-2 text-center border border-gray-300">
        {{ $user->email }}
    </td>

    <td class="py-1 px-2 text-center border border-gray-300">
        {{ $user->created_at->format('d M Y') }}
    </td>
</tr>
@empty
<tr>
    <td colspan="4"
        class="py-8 text-center text-gray-400 text-sm">
        Tidak ada pengguna yang ditemukan.
    </td>
</tr>
@endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
