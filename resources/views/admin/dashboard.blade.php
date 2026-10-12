@extends('layouts.admin')

@section('content')
<!-- Banner -->
<div class="bg-white border border-gray-200 rounded-2xl shadow
            hover:shadow-lg transition-all duration-300
            px-5 py-6
            md:px-8 md:py-6
            flex flex-col lg:flex-row
            items-center justify-between
            gap-6
            mb-6 mt-4">

    <!-- Text -->
    <div class="w-full lg:w-2/3 text-center lg:text-left order-2 lg:order-1">

        <span class="uppercase tracking-[3px] text-blue-600 font-semibold
                     text-[11px] sm:text-xs">
            Portal Layanan Perizinan
        </span>

        <h2 class="mt-3
                   text-3xl sm:text-4xl
                   font-bold text-gray-800 leading-tight">
            Selamat Datang, Admin
        </h2>

        <p class="mt-4
                  text-gray-600
                  text-base sm:text-lg
                  leading-8">
            Kelola layanan perizinan dan proses permohonan melalui sistem.
        </p>

    </div>

    <!-- Image -->
    <div class="w-full lg:w-1/3
                flex justify-center lg:justify-end
                order-1 lg:order-2">

        <img src="{{ asset('images/ad-icon.png') }}"
             class="h-36 sm:h-44 lg:h-48 object-contain">

    </div>

</div>

 <!-- Box Info -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-3 mb-8 mt-7">

    <!-- Izin Usaha Kawasan -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md
hover:bg-blue-100 hover:border-blue-400
hover:shadow-xl hover:scale-105
transition-all duration-300 
p-3 h-24 flex items-center gap-3">

     <div class="w-11 h-11 bg-indigo-100 rounded-lg flex items-center justify-center">
    <i class="fas fa-file-alt text-2xl text-indigo-600"></i>
</div>

        <div>
            <div class="text-xs font-semibold uppercase text-gray-500">
                Izin Usaha Kawasan
            </div>
            <div class="text-2xl font-bold text-gray-900">
                {{ $total_iuk ?? 0 }}
            </div>
        </div>

    </div>

    <!-- Sektor Perizinan -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md
hover:bg-blue-100 hover:border-blue-400
hover:shadow-xl hover:scale-105
transition-all duration-300
p-3 h-24 flex items-center gap-3">

        <div class="w-11 h-11 bg-teal-100 rounded-lg flex items-center justify-center">
    <i class="fas fa-building text-2xl text-teal-600"></i>
</div>

        <div>
            <div class="text-xs font-semibold uppercase text-gray-500">
                Sektor Perizinan
            </div>
            <div class="text-2xl font-bold text-gray-900">
                {{ $total_sektor_perizinan ?? 0 }}
            </div>
        </div>

    </div>

    <!-- Permohonan Masuk -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md
hover:bg-blue-100 hover:border-blue-400
hover:shadow-xl hover:scale-105
transition-all duration-300
p-3 h-24 flex items-center gap-3">

       <div class="w-11 h-11 bg-amber-100 rounded-lg flex items-center justify-center">
    <i class="fas fa-inbox text-2xl text-amber-600"></i>
</div>

        <div>
            <div class="text-xs font-semibold uppercase text-gray-500">
                Permohonan Masuk
            </div>
            <div class="text-2xl font-bold text-gray-900">
                {{ $total_pengajuan ?? 0 }}
            </div>
        </div>

    </div>

    <!-- User -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md
hover:bg-blue-100 hover:border-blue-400
hover:shadow-xl hover:scale-105
transition-all duration-300
p-3 h-24 flex items-center gap-3">

<div class="w-11 h-11 bg-slate-100 rounded-lg flex items-center justify-center">
    <i class="fas fa-users text-2xl text-slate-700"></i>
</div>

        <div>
            <div class="text-xs font-semibold uppercase text-gray-500">
                User
            </div>
            <div class="text-2xl font-bold text-gray-900">
                {{ $total_users ?? 0 }}
            </div>
        </div>

    </div>

</div>
    <!-- Aktivitas Terbaru -->
<div class="bg-white rounded-lg shadow p-4 mb-6">

    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-lg">
            Aktivitas Terbaru
        </h3>

        <span class="font-semibold text-sm pr-8">
            Waktu
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <tbody>
@forelse($aktivitas_terbaru as $aktivitas)

@php
    $status = 'Diproses';
    $bgIcon = 'bg-yellow-500';
    $bgBadge = 'bg-yellow-100';
    $textBadge = 'text-yellow-700';
    $icon = 'fa-clipboard-list';

    if(str_contains($aktivitas->aktivitas, 'Disetujui')) {
        $status = 'Disetujui';
        $bgIcon = 'bg-green-500';
        $bgBadge = 'bg-green-100';
        $textBadge = 'text-green-700';
        $icon = 'fa-check';
    }

    if(str_contains($aktivitas->aktivitas, 'Ditolak')) {
        $status = 'Ditolak';
        $bgIcon = 'bg-red-500';
        $bgBadge = 'bg-red-100';
        $textBadge = 'text-red-700';
        $icon = 'fa-times';
    }
@endphp

<tr class="border-b border-gray-100">

    <td class="py-4">

        <div class="flex items-center gap-4">

            <!-- Icon Bulat -->
            <div class="w-10 h-10 rounded-full {{ $bgIcon }} flex items-center justify-center text-white shadow">
                <i class="fas {{ $icon }}"></i>
            </div>

            <!-- Isi Aktivitas -->
            <div>

                <span class="{{ $bgBadge }} {{ $textBadge }} text-xs font-semibold px-3 py-1 rounded-lg">
                    {{ strtoupper($status) }}
                </span>

                <p class="mt-2 text-gray-800">
                    {{ $aktivitas->aktivitas }}
                </p>

            </div>

        </div>

    </td>

    <td class="py-4 text-right text-gray-400 whitespace-nowrap">

    <div class="flex items-center justify-end gap-2">
        <i class="far fa-clock text-sm text-gray-400"></i>
        <span>{{ $aktivitas->created_at->diffForHumans() }}</span>
    </div>

</td>

</tr>

@empty

<tr>
    <td colspan="2" class="text-center py-6 text-gray-400">
        Belum ada aktivitas admin
    </td>
</tr>

@endforelse
</tbody>
            </table>
        </div>
    </div>
@endsection
