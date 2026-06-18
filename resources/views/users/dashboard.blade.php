@extends('layouts.dashboard')

@section('content')

@php
    $daftarLayanan = $layanan ?? collect();
    $daftarPengajuan = $pengajuan ?? collect();
@endphp

<div class="min-h-screen bg-gray-100">

<!-- SIDEBAR -->
<aside class="fixed left-0 top-0 h-screen w-52 bg-white border-r border-gray-200 z-40">

    <!-- LOGO AREA -->
    <div class="h-24 flex items-center gap-3 px-3 border-b border-gray-200">
        <img src="{{ asset('images/logoiboss.png') }}" alt="Logo" class="w-12 h-12 object-contain">
        <div>
            <h1 class="text-base font-bold text-gray-800 leading-tight">PERIZINAN</h1>
        </div>
    </div>

    <nav class="space-y-3 p-5">

        <!-- DASHBOARD -->
        <a href="#" onclick="showDashboard()"
           id="navDashboard"
           class="flex items-center gap-3 bg-blue-50 text-blue-600 font-semibold px-4 py-3 rounded-2xl w-full hover:bg-blue-100 transition">
            <i class="fa-solid fa-house text-lg"></i>
            Dashboard
        </a>

        <!-- PERIZINAN DROPDOWN -->
        <div>
            <button onclick="toggleNavPerizinan()"
                id="navPerizinanBtn"
                class="flex items-center justify-between w-full text-sm text-gray-600 hover:text-blue-600 px-4 py-3 rounded-2xl hover:bg-gray-100 transition">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-file-shield text-lg"></i>
                    Perizinan
                </div>
                <i id="perizinanArrow" class="fa-solid fa-chevron-up text-xs transition-all duration-300"></i>
            </button>

            <!-- SUBMENU -->
            <div id="submenuPerizinan" class="hidden mt-1 space-y-1 pl-3">

                <a href="#" onclick="showIzinUsahaKawasan()"
                   id="navIzinUsahaKawasan"
                   class="flex items-center gap-2 text-xs text-gray-500 hover:text-blue-600 px-4 py-2.5 rounded-xl hover:bg-gray-100 transition">
                    <i class="fa-solid fa-building text-xs"></i>
                    Izin Usaha Kawasan
                </a>

                <a href="#" onclick="showSektorPerizinan()"
                   id="navSektorPerizinan"
                   class="flex items-center gap-2 text-xs text-gray-500 hover:text-blue-600 px-4 py-2.5 rounded-xl hover:bg-gray-100 transition">
                    <i class="fa-solid fa-layer-group text-xs"></i>
                    Sektor Perizinan
                </a>

            </div>
        </div>
        <!-- END PERIZINAN DROPDOWN -->

        <!-- AJUKAN PERIZINAN -->
        <a href="#" onclick="showAjukanPerizinan()"
           id="navAjukan"
           class="flex items-center gap-3 text-sm text-gray-600 hover:text-blue-600 px-4 py-3 rounded-2xl hover:bg-gray-100 transition">
            <i class="fa-regular fa-square-plus text-lg"></i>
            Ajukan Perizinan
        </a>

        <!-- PENGAJUAN SAYA -->
        <a href="#" onclick="showPengajuanSaya()"
           id="navPengajuan"
           class="flex items-center gap-3 text-sm text-gray-600 hover:text-blue-600 px-4 py-3 rounded-2xl hover:bg-gray-100 transition">
            <i class="fa-regular fa-folder-open text-lg"></i>
            Pengajuan Saya
        </a>

    </nav>
</aside>
<!-- END SIDEBAR -->

<!-- MAIN CONTENT -->
<main class="ml-52 min-h-screen bg-gray-100">

    <!-- TOPBAR -->
    <div class="sticky top-0 z-30 h-24 bg-white border-b border-gray-100 px-8 flex items-center justify-between">
        <div>
            <h2 id="topbarTitle" class="text-xl font-bold text-gray-800">Dashboard</h2>
            <p class="text-sm text-gray-400" id="topbarTanggal"></p>
        </div>
        <div class="flex items-center gap-5 ml-6">

            <!-- NOTIFIKASI -->
<div class="relative">
    <button id="notifBtn"
        onclick="toggleNotifikasi()"
        class="relative bg-white rounded-full p-3 border border-gray-200
               transition-all duration-200 hover:bg-blue-50 hover:border-blue-600
               hover:text-blue-600 hover:scale-105 cursor-pointer">
        <i class="fa-regular fa-bell text-gray-600 text-xl"></i>
        @if(($notifikasi_count ?? 0) > 0)
        <span id="notifBadge"
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
            {{ ($notifikasi_count ?? 0) > 9 ? '9+' : ($notifikasi_count ?? 0) }}
        </span>
        @endif
    </button>

    <!-- DROPDOWN NOTIFIKASI -->
    <div id="notifDropdown"
         class="hidden absolute right-0 mt-2 w-80 bg-white rounded-2xl border border-gray-200 shadow-xl z-50 overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-gray-50">
            <h3 class="font-bold text-gray-800 text-sm">Notifikasi</h3>
            <button onclick="bacaSemuaNotif()"
                class="text-xs text-blue-600 hover:underline font-medium">
                Tandai semua dibaca
            </button>
        </div>

        <!-- LIST NOTIFIKASI -->
        <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-gray-100">
            <div class="px-4 py-6 text-center text-sm text-gray-400">
                <i class="fa-solid fa-spinner fa-spin text-blue-400 text-xl mb-2 block"></i>
                Memuat notifikasi...
            </div>
        </div>

        <!-- FOOTER -->
        <div class="px-4 py-3 border-t border-gray-100 text-center">
            <a href="#" class="text-xs text-blue-600 hover:underline font-medium">
                Lihat semua notifikasi
            </a>
        </div>
    </div>
</div>

            <!-- USER DROPDOWN -->
            <div class="relative">
                <button id="userMenuButton"
                    class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl border border-gray-200
                           hover:border-blue-200 hover:bg-blue-50 transition cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">User</p>
                    </div>
                    <i id="dropdownIcon" class="fa-solid fa-chevron-up text-gray-400 text-xs ml-2 transition-all duration-300"></i>
                </button>

                <div id="userDropdown"
                     class="hidden absolute right-0 mt-2 w-44 bg-white rounded-xl border border-gray-200 shadow-md z-50 overflow-hidden">
                    <a href="{{ route('profile.settings') }}"
                       class="flex items-center gap-2 px-3 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                        <i class="fa-regular fa-user"></i> Edit Profile
                    </a>
                    <button type="button" onclick="openPasswordModal()"
                        class="w-full flex items-center gap-3 px-4 py-3 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition text-left">
                        <i class="fa-solid fa-key"></i> Change Password
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOPBAR -->

    <!-- ==================== -->
    <!-- DASHBOARD CONTENT    -->
    <!-- ==================== -->
    <div id="dashboardContent" class="p-8">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Halo, {{ Auth::user()->name }} 👋</h2>
            <p class="text-gray-500 mt-2">Selamat datang di portal layanan perizinan.</p>
        </div>

        <!-- SEARCH BANNER -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8 shadow-sm flex items-center justify-between">
            <div class="w-full max-w-xl">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Cari layanan perizinan yang anda butuhkan</h3>
                <div class="relative">
                    <div class="flex bg-white rounded-xl shadow overflow-hidden border border-gray-200">
                        <input type="text" id="dashboardSearch"
                            placeholder="Cari layanan atau pengajuan..."
                            class="w-full px-5 py-4 outline-none text-gray-600">
                        <button onclick="jalankanSearch()"
                            class="bg-blue-600 text-white px-6 font-semibold hover:bg-blue-700 flex items-center gap-2">
                            <i class="fa-solid fa-magnifying-glass"></i> Cari
                        </button>
                    </div>
                    <div id="searchResult"
                         class="hidden absolute left-0 top-full mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex justify-end items-center w-64">
                <img src="{{ asset('images/illustration-job.png') }}" alt="Dashboard Illustration" class="w-60"/>
            </div>
        </div>

        <!-- CARD STATISTIK -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">

    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition-all duration-300">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                <i class="fa-regular fa-file-lines text-blue-600 text-lg"></i>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-gray-700">Total Pengajuan</h3>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $total_pengajuan }}</p>
                <p class="text-xs text-gray-500 mt-1">Semua waktu</p>
            </div>
        </div>
        <svg viewBox="0 0 200 35" class="w-full h-7 mt-2">
            <path d="M0 20 C25 8, 45 30, 70 18 S115 8, 140 20 S175 30, 200 14" fill="none" stroke="#2563eb" stroke-width="3" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition-all duration-300">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                <i class="fa-regular fa-clock text-yellow-500 text-lg"></i>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-gray-700">Diproses</h3>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $total_diproses }}</p>
                <p class="text-xs text-gray-500 mt-1">Sedang berjalan</p>
            </div>
        </div>
        <svg viewBox="0 0 200 35" class="w-full h-7 mt-2">
            <path d="M0 20 C25 8, 45 30, 70 18 S115 8, 140 20 S175 30, 200 14" fill="none" stroke="#f59e0b" stroke-width="3" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition-all duration-300">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fa-regular fa-circle-check text-green-500 text-lg"></i>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-gray-700">Disetujui</h3>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $total_disetujui }}</p>
                <p class="text-xs text-gray-500 mt-1">Berhasil disetujui</p>
            </div>
        </div>
        <svg viewBox="0 0 200 35" class="w-full h-7 mt-2">
            <path d="M0 20 C25 8, 45 30, 70 18 S115 8, 140 20 S175 30, 200 14" fill="none" stroke="#22c55e" stroke-width="3" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition-all duration-300">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fa-regular fa-circle-xmark text-red-500 text-lg"></i>
            </div>
            <div>
                <h3 class="text-xs font-semibold text-gray-700">Ditolak</h3>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $total_ditolak }}</p>
                <p class="text-xs text-gray-500 mt-1">Perlu diperbaiki</p>
            </div>
        </div>
        <svg viewBox="0 0 200 35" class="w-full h-7 mt-2">
            <path d="M0 20 C25 8, 45 30, 70 18 S115 8, 140 20 S175 30, 200 14" fill="none" stroke="#ef4444" stroke-width="3" stroke-linecap="round"/>
        </svg>
    </div>

</div>
                  <!-- PENGAJUAN TERBARU -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

    <!-- Pengajuan Terbaru -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-bold text-gray-800">Pengajuan Terbaru</h3>
            <a href="#" onclick="showPengajuanSaya()" class="text-blue-600 text-sm font-semibold">
                Lihat Semua
            </a>
        </div>

        @if($pengajuan_terbaru->isEmpty())
            <div class="text-center py-8">
                <p class="text-sm text-gray-400">Belum ada pengajuan</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pengajuan_terbaru as $item)
                    <div class="flex justify-between items-center {{ !$loop->last ? 'border-b pb-4' : '' }}">
                        <div>
                            <h4 class="font-semibold text-gray-800">
                                {{ $item->layanan->nama ?? '-' }}
                            </h4>
                            <p class="text-sm text-gray-500">
                                No. Permohonan: {{ $item->no_permohonan }}
                            </p>
                        </div>

                       @if($item->status == 'menunggu')
    <span class="bg-gray-100 text-gray-700 px-5 py-2 rounded-full text-sm font-semibold">
        Menunggu
    </span>
@elseif($item->status == 'diproses')
    <span class="bg-yellow-100 text-yellow-600 px-5 py-2 rounded-full text-sm font-semibold">
        Diproses
    </span>
@elseif($item->status == 'disetujui')
    <span class="bg-green-100 text-green-600 px-5 py-2 rounded-full text-sm font-semibold">
        Disetujui
    </span>
@elseif($item->status == 'ditolak')
    <span class="bg-red-100 text-red-600 px-5 py-2 rounded-full text-sm font-semibold">
        Ditolak
    </span>
@endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Status Pengajuan -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-5">Status Pengajuan</h3>

        @if($pengajuan_aktif)
            <div class="space-y-5">

                <div>
                    <p class="font-semibold text-gray-800">Dokumen Diterima</p>
                    <p class="text-sm text-gray-500">
                        {{ $pengajuan_aktif->created_at->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">Verifikasi Dokumen</p>
                    <p class="text-sm text-gray-500">
                        {{ $pengajuan_aktif->updated_at->format('d M Y') }}
                    </p>
                </div>

                @if($pengajuan_aktif->status == 'diproses')
                    <div>
                        <p class="font-semibold text-yellow-600">Proses Approval</p>
                        <p class="text-sm text-gray-500">Sedang dalam proses</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-400">Selesai</p>
                        <p class="text-sm text-gray-500">Menunggu persetujuan akhir</p>
                    </div>
                @elseif($pengajuan_aktif->status == 'disetujui')
                    <div>
                        <p class="font-semibold text-green-600">Selesai</p>
                        <p class="text-sm text-gray-500">Pengajuan telah disetujui</p>
                    </div>
                @elseif($pengajuan_aktif->status == 'ditolak')
                    <div>
                        <p class="font-semibold text-red-600">Ditolak</p>
                        <p class="text-sm text-gray-500">Pengajuan tidak disetujui</p>
                    </div>
                @else
                    <div>
                        <p class="font-semibold text-gray-600">Menunggu</p>
                        <p class="text-sm text-gray-500">Pengajuan sedang menunggu proses verifikasi</p>
                    </div>
                @endif

            </div>
        @else
            <p class="text-sm text-gray-400">Belum ada pengajuan aktif</p>
        @endif
    </div>

</div>

    </div>
    <!-- END DASHBOARD CONTENT -->

    <!-- IZIN USAHA KAWASAN CONTENT -->
<div id="izinUsahaKawasanContent" class="hidden p-8">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Izin Usaha Kawasan</h2>
        <p class="text-gray-500 mt-2">Layanan perizinan usaha di kawasan industri.</p>
    </div>

    @if($iukList->isEmpty())
        <div class="bg-white rounded-2xl shadow p-12 text-center">
            <i class="fa-solid fa-building text-5xl text-gray-200 mb-4 block"></i>
            <h3 class="text-lg font-semibold text-gray-500">Belum ada layanan IUK</h3>
            <p class="text-sm text-gray-400 mt-2">Layanan akan ditampilkan setelah admin menambahkan data.</p>
        </div>
    @else
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($iukList as $iuk)
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden flex flex-col">

                <!-- GAMBAR -->
                <div class="w-full h-36 overflow-hidden bg-blue-50 rounded-t-2xl flex-shrink-0">
                    @if($iuk->image)
                        <img src="{{ asset('images/' . $iuk->image) }}"
                             alt="{{ $iuk->nama }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center ">
                            <i class="fa-solid fa-file-shield text-4xl text-blue-200"></i>
                        </div>
                    @endif
                </div>

                <!-- KONTEN -->
                <div class="p-4 flex flex-col flex-1">
                    <h4 class="font-bold text-gray-800 text-base mb-2 line-clamp-2">
                        {{ $iuk->nama }}
                    </h4>
                    <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                        {{ $iuk->deskripsi }}
                    </p>

                    <!-- TOMBOL -->
                    <a href="{{ route('layanan.show', $iuk->id) }}"
                        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-xl transition mt-auto">
                        Lihat Detail
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    @endif

</div>
<!-- END IZIN USAHA KAWASAN CONTENT -->


             <!-- SEKTOR PERIZINAN CONTENT -->
<div id="sektorPerizinanContent" class="hidden p-8">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">
            Sektor Perizinan
        </h2>
        <p class="text-gray-500 mt-2">
            Perizinan berdasarkan sektor usaha.
        </p>
    </div>

    @if($perizinanList->isEmpty())

        <div class="bg-white rounded-2xl shadow p-12 text-center">
            <i class="fa-solid fa-layer-group text-5xl text-blue-200 mb-4"></i>

            <h3 class="text-lg font-semibold text-gray-500">
                Belum ada data sektor perizinan
            </h3>

            <p class="text-sm text-gray-400 mt-2">
                Data akan ditampilkan setelah admin menambahkan data.
            </p>
        </div>

    @else

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            @foreach($perizinanList as $perizinan)

            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden flex flex-col">

                <!-- GAMBAR -->
                <div class="w-full h-36 overflow-hidden bg-blue-50 rounded-t-2xl flex-shrink-0">

                    @if($perizinan->image)
                        <img src="{{ asset('images/' . $perizinan->image) }}"
                             alt="{{ $perizinan->nama }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fa-solid fa-layer-group text-4xl text-blue-200"></i>
                        </div>
                    @endif

                </div>

                <!-- KONTEN -->
                <div class="p-4 flex flex-col flex-1">

                    <h4 class="font-bold text-gray-800 text-base mb-2 line-clamp-2">
                        {{ $perizinan->nama }}
                    </h4>

                    <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                        {{ $perizinan->deskripsi }}
                    </p>

                    <a href="{{ route('perizinan.show', $perizinan->id) }}"
                       class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-xl transition mt-auto">
                        Lihat Detail
                    </a>

                </div>

            </div>

            @endforeach

        </div>

    @endif

</div>
<!-- END SEKTOR PERIZINAN CONTENT -->

    <!-- ======================== -->
    <!-- AJUKAN PERIZINAN CONTENT -->
    <!-- ======================== -->
    <div id="ajukanPerizinanContent" class="hidden p-8">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Ajukan Perizinan</h2>
            <p class="text-gray-500 mt-2">Silakan isi form berikut untuk mengajukan perizinan.</p>
        </div>

        <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-5xl">

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Jenis Perizinan <span class="text-red-500">*</span>
                        
                    </label>
                    <select name="layanan_id"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 @error('layanan_id') border-red-400 @enderror">
                        <option value="">Pilih layanan</option>
                        @foreach($daftarLayanan as $item)
                            <option value="{{ $item->id }}" {{ old('layanan_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('layanan_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_lengkap"
                        value="{{ old('nama_lengkap', Auth::user()->name) }}"
                        placeholder="Masukkan nama lengkap"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 @error('nama_lengkap') border-red-400 @enderror">
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nik" value="{{ old('nik') }}"
                        placeholder="Masukkan 16 digit NIK" maxlength="16"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 @error('nik') border-red-400 @enderror">
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        No. Telepon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                        placeholder="Contoh: 08123456789"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 @error('no_telepon') border-red-400 @enderror">
                    @error('no_telepon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 @error('alamat') border-red-400 @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="3"
                        placeholder="Isi jika ada keterangan tambahan (opsional)"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500">{{ old('keterangan') }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Dokumen/Foto</label>
                    <div class="w-56">
                        <label for="file_dokumen"
                            class="flex flex-col items-center justify-center w-56 h-56 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition relative overflow-hidden">
                            <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 mb-2"></i>
                                <p class="text-xs text-gray-500">Klik untuk upload</p>
                                <p class="text-xs text-gray-400 mt-1">PDF, JPG, PNG · Maks 2MB</p>
                            </div>
                            <div id="previewImageWrapper" class="hidden flex-col items-center justify-center gap-2 p-3">
                                <img id="imgPreview" src="" alt="Preview"
                                    class="w-28 h-28 object-cover rounded-lg border border-gray-200 shadow-sm">
                                <p class="text-xs text-gray-400">Klik untuk ganti</p>
                            </div>
                            <div id="previewPdf" class="hidden flex-col items-center justify-center gap-2 p-3">
                                <i class="fa-solid fa-file-pdf text-red-500 text-5xl"></i>
                                <p class="text-xs text-gray-600 font-semibold text-center px-3 truncate w-full" id="pdfFileName"></p>
                                <p class="text-xs text-gray-400">Klik untuk ganti</p>
                            </div>
                        </label>
                        <input type="file" id="file_dokumen" name="file_dokumen"
                            accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="previewDokumen(event)">
                        <div id="fileInfo" class="hidden mt-2 flex items-center justify-between">
                            <p class="text-xs text-gray-500 truncate max-w-xs" id="fileName"></p>
                            <button type="button" onclick="hapusDokumen()"
                                class="text-red-400 hover:text-red-600 text-xs ml-2 flex-shrink-0">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                    @error('file_dokumen')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex gap-3 mt-8 items-center">
                <button type="button" onclick="showDashboard()"
                    class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm w-fit">
                    Batal
                </button>
                <button type="submit"
    class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition text-sm w-fit">
    <i class="fa-solid fa-file-signature mr-2"></i>
    Ajukan Perizinan
</button>
            </div>
        </form>

    </div>
    <!-- END AJUKAN PERIZINAN CONTENT -->

    <!-- ====================== -->
    <!-- PENGAJUAN SAYA CONTENT -->
    <!-- ====================== -->
    <div id="pengajuanSayaContent" class="hidden p-8">

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Pengajuan Saya</h2>
            <p class="text-gray-500 mt-2">Daftar semua pengajuan perizinan yang pernah anda ajukan.</p>
        </div>

        @if($daftarPengajuan->isEmpty())
            <div class="bg-white rounded-2xl shadow p-12 text-center">
                <i class="fa-regular fa-folder-open text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-500">Belum ada pengajuan</h3>
                <p class="text-sm text-gray-400 mt-2">Kamu belum pernah mengajukan perizinan.</p>
                <button onclick="showAjukanPerizinan()"
                    class="mt-5 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm hover:bg-blue-700 transition">
                    Ajukan Sekarang
                </button>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <div class="grid grid-cols-5 gap-4 px-6 py-4 bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase">
                    <div>No. Permohonan</div>
                    <div>Jenis Perizinan</div>
                    <div>Tanggal</div>
                    <div>Status</div>
                    <div>Aksi</div>
                </div>
                @foreach($daftarPengajuan as $item)
                <div class="grid grid-cols-5 gap-4 px-6 py-4 border-b border-gray-100 items-center hover:bg-gray-50 transition">
                    <div><p class="text-sm font-semibold text-gray-800">{{ $item->no_permohonan }}</p></div>
                    <div><p class="text-sm text-gray-700">{{ $item->layanan->nama ?? '-' }}</p></div>
                    <div><p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</p></div>
                    <div>
                        @if($item->status == 'menunggu')
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>
                        @elseif($item->status == 'diproses')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Diproses</span>
                        @elseif($item->status == 'disetujui')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">Disetujui</span>
                        @elseif($item->status == 'ditolak')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>
                        @endif
                    </div>
                    <div>
                        <button type="button"
                            onclick='lihatDetail(
                            @json($item->id),
    @json($item->no_permohonan),
    @json($item->layanan->nama ?? "-"),
    @json($item->nama_lengkap),
    @json($item->nik),
    @json($item->no_telepon),
    @json($item->alamat),
    @json($item->keterangan ?? "-"),
    @json($item->status),
    @json($item->created_at->format("d M Y")),
    @json($item->file_dokumen ? asset("storage/" . $item->file_dokumen) : ""),
    @json($item->catatan_admin ?? "")
)'
                            class="text-blue-600 hover:text-blue-800 text-xs font-semibold flex items-center gap-1">
                            <i class="fa-regular fa-eye"></i> Lihat Detail
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
    <!-- END PENGAJUAN SAYA CONTENT -->

</main>
<!-- END MAIN -->

</div>

<!-- MODAL CHANGE PASSWORD -->
<div id="passwordModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6 relative">
        <button type="button" onclick="closePasswordModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-red-500">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
        <h2 class="text-xl font-bold text-gray-800">Change Password</h2>
        <p class="text-sm text-gray-500 mt-1 mb-5">Ubah password akun anda.</p>
        <form action="{{ route('password.change') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="relative">
                <input type="password" id="current_password" name="current_password"
                    placeholder="Password lama"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-12 text-sm">
                <button type="button" onclick="togglePassword('current_password', 'eye1')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                    <i id="eye1" class="fa-regular fa-eye-slash"></i>
                </button>
            </div>
            <div class="relative">
                <input type="password" id="new_password" name="new_password"
                    placeholder="Password baru"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-12 text-sm">
                <button type="button" onclick="togglePassword('new_password', 'eye2')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                    <i id="eye2" class="fa-regular fa-eye-slash"></i>
                </button>
            </div>
            <div class="relative">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    placeholder="Konfirmasi password baru"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-12 text-sm">
                <button type="button" onclick="togglePassword('new_password_confirmation', 'eye3')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                    <i id="eye3" class="fa-regular fa-eye-slash"></i>
                </button>
            </div>
            <div class="flex justify-end gap-2 pt-3">
                <button type="button" onclick="closePasswordModal()"
                    class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-sm">Batal</button>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL PASSWORD BERHASIL -->
<div id="passwordSuccessModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-8 text-center relative">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
            <i class="fa-solid fa-lock text-green-500 text-4xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Password Diperbarui!</h2>
        <p class="text-gray-500 text-sm mb-6">Password akun anda telah berhasil diperbarui.</p>
        <button onclick="document.getElementById('passwordSuccessModal').classList.add('hidden')"
            class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition font-semibold">OK</button>
    </div>
</div>

<!-- MODAL SUKSES PENGAJUAN -->
<div id="successModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-xl p-8 text-center relative">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
            <i class="fa-solid fa-circle-check text-green-500 text-5xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pengajuan Berhasil!</h2>
        <p class="text-gray-500 text-sm mb-4">Pengajuan perizinan anda telah berhasil dikirim dan sedang diproses.</p>
        <div class="bg-blue-50 border border-blue-200 rounded-xl px-4 py-3 mb-6">
            <p class="text-xs text-gray-500 mb-1">Nomor Permohonan</p>
            <p class="text-blue-700 font-bold text-sm">
                @if(session('no_permohonan')){{ session('no_permohonan') }}@endif
            </p>
        </div>
        <button onclick="closeSuccessModal()"
            class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition font-semibold">OK, Mengerti</button>
    </div>
</div>

<!-- MODAL DETAIL PENGAJUAN -->
<div id="detailModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-start justify-center p-4 overflow-y-auto">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative my-10">
        <button type="button" onclick="document.getElementById('detailModal').classList.add('hidden')"
            class="absolute top-4 right-4 text-gray-400 hover:text-red-500">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
        <h2 class="text-xl font-bold text-gray-800 mb-1">Detail Pengajuan</h2>
        <p class="text-sm text-gray-400 mb-5" id="detail_no_permohonan"></p>
        <div class="mb-5" id="detail_status_wrapper"></div>
        <div class="space-y-3">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Jenis Perizinan</p>
                    <p class="text-sm font-semibold text-gray-700" id="detail_layanan"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Tanggal Pengajuan</p>
                    <p class="text-sm font-semibold text-gray-700" id="detail_tanggal"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Nama Lengkap</p>
                    <p class="text-sm font-semibold text-gray-700" id="detail_nama"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">NIK</p>
                    <p class="text-sm font-semibold text-gray-700" id="detail_nik"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">No. Telepon</p>
                    <p class="text-sm font-semibold text-gray-700" id="detail_telepon"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Alamat</p>
                    <p class="text-sm font-semibold text-gray-700" id="detail_alamat"></p>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-400 mb-1">Keterangan</p>
                <p class="text-sm font-semibold text-gray-700" id="detail_keterangan"></p>
            </div>
            <div id="catatan_admin_wrapper"
     class="hidden rounded-xl p-4 border">
    <p id="catatan_admin_label" class="text-xs mb-1">Catatan Admin</p>
    <p id="detail_catatan_admin" class="text-sm font-semibold"></p>
</div>
            <div id="detail_dokumen_wrapper" class="bg-gray-50 rounded-xl p-3 hidden">
                <p class="text-xs text-gray-400 mb-2">Dokumen Terlampir</p>
                <a id="detail_dokumen_link" href="#" target="_blank"
                    class="inline-flex items-center gap-2 text-blue-600 text-sm font-semibold hover:underline">
                    <i class="fa-solid fa-paperclip"></i> Lihat Dokumen
                </a>
            </div>
            <div id="upload_ulang_wrapper"
     class="hidden bg-gray-50 rounded-xl p-3">

    <p class="text-xs text-gray-400 mb-2">
        Upload Ulang Dokumen
    </p>

    <form id="uploadUlangForm"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <input type="file"
               name="file_dokumen"
               accept=".pdf,.jpg,.jpeg,.png"
               required
               class="w-full border border-gray-200 rounded-xl px-3 py-2 mb-3 text-sm">

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm">
            Kirim Ulang Dokumen
        </button>
    </form>
</div>
        </div>
    </div>
</div>

<script>

    // ========================
    // HIDE ALL CONTENT
    // ========================
    function hideAllContent() {
        [
            'dashboardContent',
            'izinUsahaKawasanContent',
            'sektorPerizinanContent',
            'ajukanPerizinanContent',
            'pengajuanSayaContent'
        ].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        });
    }

    // ========================
    // SET ACTIVE NAV
    // ========================
    function setActiveNav(activeId) {
        [
            'navDashboard', 'navPerizinanBtn',
            'navIzinUsahaKawasan', 'navSektorPerizinan',
            'navAjukan', 'navPengajuan'
        ].forEach(function(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.remove('bg-blue-50', 'text-blue-600', 'font-semibold');
            el.classList.add('text-gray-600');
        });
        const active = document.getElementById(activeId);
        if (active) {
            active.classList.add('bg-blue-50', 'text-blue-600', 'font-semibold');
            active.classList.remove('text-gray-600');
        }
    }

    // ========================
    // UPDATE TOPBAR TITLE
    // ========================
    function updateTopbarTitle(title) {
        const el = document.getElementById('topbarTitle');
        if (el) el.textContent = title;
    }

    // ========================
    // TOGGLE DROPDOWN PERIZINAN
    // ========================
    function toggleNavPerizinan() {
        const submenu = document.getElementById('submenuPerizinan');
        const arrow = document.getElementById('perizinanArrow');
        const btn = document.getElementById('navPerizinanBtn');

        submenu.classList.toggle('hidden');

        if (submenu.classList.contains('hidden')) {
            // Tertutup → panah bawah
            arrow.classList.remove('fa-chevron-down');
            arrow.classList.add('fa-chevron-up');
            btn.classList.remove('bg-blue-50', 'text-blue-600', 'font-semibold');
            btn.classList.add('text-gray-600');
        } else {
            // Terbuka → panah atas
            arrow.classList.remove('fa-chevron-up');
            arrow.classList.add('fa-chevron-down');
            btn.classList.add('bg-blue-50', 'text-blue-600', 'font-semibold');
            btn.classList.remove('text-gray-600');
        }
    }

    // ========================
    // NAVIGASI
    // ========================
    function showDashboard() {
        hideAllContent();
        document.getElementById('dashboardContent').classList.remove('hidden');
        setActiveNav('navDashboard');
        updateTopbarTitle('Dashboard');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showIzinUsahaKawasan() {
        hideAllContent();
        document.getElementById('izinUsahaKawasanContent').classList.remove('hidden');
        setActiveNav('navIzinUsahaKawasan');
        updateTopbarTitle('Izin Usaha Kawasan');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showSektorPerizinan() {
        hideAllContent();
        document.getElementById('sektorPerizinanContent').classList.remove('hidden');
        setActiveNav('navSektorPerizinan');
        updateTopbarTitle('Sektor Perizinan');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showAjukanPerizinan() {
        hideAllContent();
        document.getElementById('ajukanPerizinanContent').classList.remove('hidden');
        setActiveNav('navAjukan');
        updateTopbarTitle('Ajukan Perizinan');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showPengajuanSaya() {
        hideAllContent();
        document.getElementById('pengajuanSayaContent').classList.remove('hidden');
        setActiveNav('navPengajuan');
        updateTopbarTitle('Pengajuan Saya');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ========================
    // PASSWORD MODAL
    // ========================
    function openPasswordModal() {
        document.getElementById('passwordModal').classList.remove('hidden');
    }
    function closePasswordModal() {
        document.getElementById('passwordModal').classList.add('hidden');
    }
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);
        if (input.type === 'password') {
            input.type = 'text';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        } else {
            input.type = 'password';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        }
    }

    // ========================
    // SUCCESS MODAL
    // ========================
    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
    }

    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('successModal').classList.remove('hidden');
            showDashboard();
        });
    @endif

    @if(session('password_success'))
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('passwordSuccessModal').classList.remove('hidden');
        });
    @endif

    // ========================
    // USER DROPDOWN
    // ========================
    document.getElementById('userMenuButton').addEventListener('click', function() {
        const dropdown = document.getElementById('userDropdown');
        const icon = document.getElementById('dropdownIcon');
        dropdown.classList.toggle('hidden');
        if (dropdown.classList.contains('hidden')) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    });

    // ========================
    // SEARCH
    // ========================
    const searchInput = document.getElementById('dashboardSearch');
    const searchResult = document.getElementById('searchResult');
    let selectedItem = null;

    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') { jalankanSearch(); return; }
        const keyword = this.value.trim();
        selectedLayananId = null;
        if (keyword.length < 2) {
            searchResult.classList.add('hidden');
            searchResult.innerHTML = '';
            return;
        }
        fetchSearch(keyword);
    });

    function fetchSearch(keyword) {
        fetch(`/dashboard-search?keyword=${encodeURIComponent(keyword)}`)
            .then(r => r.json())
            .then(data => {
                searchResult.innerHTML = '';
                if (data.length === 0) {
                    searchResult.innerHTML = `<div class="px-4 py-3 text-sm text-gray-500">Layanan tidak ditemukan</div>`;
                } else {
                    data.forEach(item => {
                        searchResult.innerHTML += `
                            <div onclick="pilihItem(${item.id}, '${item.nama}', '${item.jenis}')"
                                class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 cursor-pointer">
                                <i class="fa-solid fa-magnifying-glass text-gray-400 mr-2 text-xs"></i>${item.nama}
                            </div>`;
                    });
                }
                searchResult.classList.remove('hidden');
            });
    }

    function pilihItem(id, nama, jenis)
{
    selectedItem = {
        id: id,
        jenis: jenis
    };

    searchInput.value = nama;

    searchResult.classList.add('hidden');
    searchResult.innerHTML = '';
}

    function jalankanSearch() {
        if (selectedItem) {

    if (selectedItem.jenis === 'perizinan') {
        window.location.href =
            `/perizinan/${selectedItem.id}`;
    } else {
        window.location.href =
            `/layanan/${selectedItem.id}`;
    }

    return;
}
        const keyword = searchInput.value.trim();
        if (keyword.length < 2) {
            searchResult.innerHTML = `<div class="px-4 py-3 text-sm text-gray-500">Masukkan minimal 2 huruf</div>`;
            searchResult.classList.remove('hidden');
            return;
        }
        fetch(`/dashboard-search?keyword=${encodeURIComponent(keyword)}`)
            .then(r => r.json())
            .then(data => {
                if (data.length === 0) {
                    searchResult.innerHTML = `<div class="px-4 py-3 text-sm text-gray-500">Layanan tidak ditemukan</div>`;
                    searchResult.classList.remove('hidden');
                } else if (data.length === 1) {

    if (data[0].jenis === 'perizinan') {
        window.location.href =
            `/perizinan/${data[0].id}`;
    } else {
        window.location.href =
            `/layanan/${data[0].id}`;
    }
}
            });
    }

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResult.contains(e.target)) {
            searchResult.classList.add('hidden');
        }
    });

    // ========================
    // PREVIEW DOKUMEN
    // ========================
    function previewDokumen(event) {
        const file = event.target.files[0];
        if (!file) return;
        document.getElementById('fileInfo').classList.remove('hidden');
        document.getElementById('fileName').textContent = file.name;
        document.getElementById('uploadPlaceholder').classList.add('hidden');
        if (file.type === 'application/pdf') {
            document.getElementById('previewImageWrapper').classList.add('hidden');
            document.getElementById('previewImageWrapper').classList.remove('flex');
            document.getElementById('previewPdf').classList.remove('hidden');
            document.getElementById('previewPdf').classList.add('flex');
            document.getElementById('pdfFileName').textContent = file.name;
        } else {
            document.getElementById('previewPdf').classList.add('hidden');
            document.getElementById('previewPdf').classList.remove('flex');
            document.getElementById('previewImageWrapper').classList.remove('hidden');
            document.getElementById('previewImageWrapper').classList.add('flex');
            const reader = new FileReader();
            reader.onload = function(e) { document.getElementById('imgPreview').src = e.target.result; };
            reader.readAsDataURL(file);
        }
    }

    function hapusDokumen() {
        document.getElementById('file_dokumen').value = '';
        document.getElementById('uploadPlaceholder').classList.remove('hidden');
        document.getElementById('previewImageWrapper').classList.add('hidden');
        document.getElementById('previewImageWrapper').classList.remove('flex');
        document.getElementById('imgPreview').src = '';
        document.getElementById('previewPdf').classList.add('hidden');
        document.getElementById('previewPdf').classList.remove('flex');
        document.getElementById('fileInfo').classList.add('hidden');
        document.getElementById('fileName').textContent = '';
        document.getElementById('pdfFileName').textContent = '';
    }

    // ========================
    // LIHAT DETAIL PENGAJUAN
    // ========================
    function lihatDetail(
    id,
    noPermohonan,
    layanan,
    nama,
    nik,
    telepon,
    alamat,
    keterangan,
    status,
    tanggal,
    fileDokumen,
    catatanAdmin
) {
        document.getElementById('detail_no_permohonan').textContent = 'No. ' + noPermohonan;
        document.getElementById('detail_layanan').textContent = layanan;
        document.getElementById('detail_nama').textContent = nama;
        document.getElementById('detail_nik').textContent = nik;
        document.getElementById('detail_telepon').textContent = telepon;
        document.getElementById('detail_alamat').textContent = alamat;
        document.getElementById('detail_keterangan').textContent = keterangan;
        document.getElementById('detail_tanggal').textContent = tanggal;
        const statusMap = {
            'menunggu': '<span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>',
            'diproses': '<span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Diproses</span>',
            'disetujui': '<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">Disetujui</span>',
            'ditolak': '<span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-medium">Ditolak</span>',
        };
        document.getElementById('detail_status_wrapper').innerHTML = statusMap[status] || status;
        if (fileDokumen) {
            document.getElementById('detail_dokumen_wrapper').classList.remove('hidden');
            document.getElementById('detail_dokumen_link').href = fileDokumen;
        } else {
            document.getElementById('detail_dokumen_wrapper').classList.add('hidden');
        }
      const catatanBox = document.getElementById('catatan_admin_wrapper');
const catatanLabel = document.getElementById('catatan_admin_label');
const catatanText = document.getElementById('detail_catatan_admin');

catatanBox.classList.remove(
    'hidden',
    'bg-red-50', 'border-red-200',
    'bg-yellow-50', 'border-yellow-200',
    'bg-green-50', 'border-green-200',
    'bg-gray-50', 'border-gray-200'
);

catatanLabel.classList.remove(
    'text-red-500',
    'text-yellow-600',
    'text-green-600',
    'text-gray-500',
    'text-gray-700'
);

catatanText.classList.remove(
    'text-red-700',
    'text-yellow-700',
    'text-green-700',
    'text-gray-700'
);

catatanBox.classList.remove('hidden');

let pesanStatus = '';

if (status === 'ditolak') {
    pesanStatus = catatanAdmin && catatanAdmin.trim() !== ''
        ? catatanAdmin
        : 'Perizinan Anda ditolak. Silakan periksa kembali persyaratan yang diperlukan.';

    catatanBox.classList.add('bg-red-50', 'border-red-200');
    catatanLabel.classList.add('text-gray-700');
    catatanText.classList.add('text-red-700');

} else if (status === 'diproses') {
    pesanStatus = 'Perizinan Anda sedang diproses oleh admin.';

    catatanBox.classList.add('bg-yellow-50', 'border-yellow-200');
    catatanLabel.classList.add('text-gray-700');
    catatanText.classList.add('text-yellow-700');

} else if (status === 'disetujui') {
    pesanStatus = 'Perizinan Anda telah disetujui.';

    catatanBox.classList.add('bg-green-50', 'border-green-200');
    catatanLabel.classList.add('text-gray-700');
    catatanText.classList.add('text-green-700');

} else {
    pesanStatus = 'Perizinan Anda sedang menunggu verifikasi.';

    catatanBox.classList.add('bg-gray-50', 'border-gray-200');
    catatanLabel.classList.add('text-gray-700');
    catatanText.classList.add('text-gray-700');
}

catatanText.textContent = pesanStatus;
const uploadUlangWrapper = document.getElementById('upload_ulang_wrapper'); 
const uploadUlangForm = document.getElementById('uploadUlangForm');

if (status === 'ditolak') {
    uploadUlangWrapper.classList.remove('hidden');
    uploadUlangForm.action = '/pengajuan/' + id + '/upload-ulang';
} else {
    uploadUlangWrapper.classList.add('hidden'); 
}
        document.getElementById('detailModal').classList.remove('hidden');
    }

    // ========================
    // TANGGAL OTOMATIS
    // ========================
    const hariList = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const now = new Date();
    document.getElementById('topbarTanggal').textContent =
        `${hariList[now.getDay()]}, ${now.getDate()} ${bulanList[now.getMonth()]} ${now.getFullYear()}`;

// NOTIFIKASI
function toggleNotifikasi() {
    const dropdown = document.getElementById('notifDropdown');
    dropdown.classList.toggle('hidden');
    if (!dropdown.classList.contains('hidden')) {
        loadNotifikasi();
    }
}

function loadNotifikasi() {
    const list = document.getElementById('notifList');
    list.innerHTML = `
        <div class="px-4 py-6 text-center text-sm text-gray-400">
            <i class="fa-solid fa-spinner fa-spin text-blue-400 text-xl mb-2 block"></i>
            Memuat notifikasi...
        </div>`;

    fetch('/notifikasi')
        .then(r => r.json())
        .then(data => {
            if (data.length === 0) {
                list.innerHTML = `
                    <div class="px-4 py-8 text-center">
                        <i class="fa-regular fa-bell-slash text-gray-300 text-3xl mb-2 block"></i>
                        <p class="text-sm text-gray-400">Belum ada notifikasi</p>
                    </div>`;
                return;
            }

            list.innerHTML = '';
            data.forEach(item => {
                const ikonMap = {
                    'success': 'fa-circle-check text-green-500',
                    'warning': 'fa-circle-xmark text-red-500',
                    'info':    'fa-clock text-yellow-500',
                };
                const bgMap = {
                    'success': 'bg-green-50',
                    'warning': 'bg-red-50',
                    'info':    'bg-yellow-50',
                };
                const ikon = ikonMap[item.tipe] || 'fa-bell text-blue-500';
                const bg = item.dibaca ? '' : (bgMap[item.tipe] || 'bg-blue-50');

                const div = document.createElement('div');
                div.className = `flex items-start gap-3 px-4 py-3 ${bg} hover:bg-gray-50 transition cursor-pointer notif-item`;
                div.dataset.id = item.id;
                div.dataset.dibaca = item.dibaca ? '1' : '0';
                div.innerHTML = `
                    <div class="mt-0.5 flex-shrink-0">
                        <i class="fa-solid ${ikon} text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800">${item.judul}</p>
                        <p class="text-xs text-gray-500 mt-0.5">${item.pesan}</p>
                        <p class="text-xs text-gray-400 mt-1">${formatWaktu(item.created_at)}</p>
                    </div>
                    ${!item.dibaca ? '<div class="titik-biru w-2 h-2 bg-blue-500 rounded-full mt-1.5 flex-shrink-0"></div>' : ''}
                `;

                // Pasang event klik langsung ke elemen
                div.addEventListener('click', function() {
                    if (this.dataset.dibaca === '1') return; // Sudah dibaca, skip
                    const notifId = this.dataset.id;

                    fetch(`/notifikasi/${notifId}/baca`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        }
                    }).then(r => r.json()).then(() => {
                        // Tandai sudah dibaca
                        this.dataset.dibaca = '1';

                        // Hapus background warna
                        this.classList.remove('bg-green-50', 'bg-red-50', 'bg-yellow-50', 'bg-blue-50');

                        // Hapus titik biru
                        const titik = this.querySelector('.titik-biru');
                        if (titik) titik.remove();

                        // Kurangi badge
                        kurangiBadge();
                    });
                });

                list.appendChild(div);
            });
        })
        .catch(() => {
            list.innerHTML = `
                <div class="px-4 py-6 text-center text-sm text-red-400">
                    Gagal memuat notifikasi.
                </div>`;
        });
}

function kurangiBadge() {
    const badge = document.getElementById('notifBadge');
    if (!badge) return;
    let count = parseInt(badge.textContent);
    if (isNaN(count)) count = 1;
    count--;
    if (count <= 0) {
        badge.remove();
    } else {
        badge.textContent = count > 9 ? '9+' : count;
    }
}

function bacaSemuaNotif() {
    fetch('/notifikasi/baca-semua', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    }).then(r => r.json()).then(() => {
        const badge = document.getElementById('notifBadge');
        if (badge) badge.remove();
        loadNotifikasi();
    });
}

function formatWaktu(dateStr) {
    const date = new Date(dateStr);
    const now = new Date();
    const diff = Math.floor((now - date) / 1000);
    if (diff < 60) return 'Baru saja';
    if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
    if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
    return Math.floor(diff / 86400) + ' hari lalu';
}

// Tutup notif dropdown saat klik di luar
document.addEventListener('click', function(e) {
    const btn = document.getElementById('notifBtn');
    const dropdown = document.getElementById('notifDropdown');
    if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>

@endsection