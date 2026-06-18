@extends('layouts.admin')

@section('content')


    <!-- Banner -->
    <div class="bg-yellow-400 rounded-xl p-5 sm:p-6 flex flex-col-reverse sm:flex-row items-center gap-3 mb-5 mt-4">
        <div class="w-full sm:w-2/3 flex flex-col items-center sm:items-start">
            <h2 class="text-2xl font-bold text-white">Selamat Datang, Admin</h2>
            <p class="text-white font-bold">Sistem Informasi Portal Layanan Perizinan</p>
        </div>

        <div class="w-full sm:w-1/3 flex justify-center sm:justify-end">
            <img src="{{ asset('images/ad-icon.png') }}" class="h-32 sm:h-44 object-contain -mt-6 sm:-mt-12">
        </div>
    </div>

    <!-- Box Info -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-3 mb-8 mt-7">
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-3 h-24 rounded-xl flex items-center gap-2 shadow-md hover:scale-105 transition">

    <div class="w-11 h-11 bg-white/20 rounded-lg flex items-center justify-center">
        <i class="fas fa-file-alt text-3xl"></i>
    </div>

    <div>
        <div class="text-xs font-semibold uppercase">
            Izin Usaha Kawasan
        </div>
        <div class="text-2xl font-bold">
            {{ $total_iuk ?? 0 }}
        </div>
    </div>

</div>

    <div class="bg-gradient-to-r from-teal-400 to-teal-600 text-white p-3 h-24 rounded-xl flex items-center gap-2 shadow-md hover:scale-105 transition">

    <div class="w-11 h-11 bg-white/20 rounded-lg flex items-center justify-center">
        <i class="fas fa-building text-3xl"></i>
    </div>

    <div>
        <div class="text-xs font-semibold uppercase">
            Sektor Perizinan
        </div>
        <div class="text-2xl font-bold">
            {{ $total_sektor_perizinan ?? 0 }}
        </div>
    </div>

</div>
<div class="bg-gradient-to-r from-orange-400 to-orange-600 text-white p-3 h-24 rounded-xl flex items-center gap-2 shadow-md hover:scale-105 transition">

    <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
        <i class="fas fa-inbox text-3xl"></i>
    </div>

    <div>
        <div class="text-xs font-semibold uppercase">
            Pengajuan Masuk
        </div>
        <div class="text-2xl font-bold">
            {{ $total_pengajuan ?? 0 }}
        </div>
    </div>

</div>
    

   <div class="bg-gradient-to-r from-purple-500 to-purple-700 text-white p-3 h-24 rounded-xl flex items-center gap-2 shadow-md hover:scale-105 transition">

    <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
        <i class="fas fa-users text-3xl"></i>
    </div>

    <div>
        <div class="text-xs font-semibold uppercase">
            User
        </div>
        <div class="text-2xl font-bold">
            {{ $total_users ?? 0 }}
        </div>
    </div>

</div>
</div>
    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <h3 class="font-bold text-lg mb-4">Aktivitas Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-left pb-2 font-semibold">Aktivitas</th>
                        <th class="text-right pr-8 pb-2 font-semibold">Waktu</th>
                    </tr>
                </thead>
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
