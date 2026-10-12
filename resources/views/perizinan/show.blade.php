```blade
@extends('layouts.app')

@section('content')

@php
    // Membaca persyaratan dari database
    $persyaratanList = preg_split(
        '/\r\n|\r|\n/',
        trim((string) $perizinan->persyaratan)
    );

    $persyaratanList = array_values(array_filter(
        array_map('trim', $persyaratanList),
        fn ($item) => $item !== ''
    ));

    // Membaca alur layanan dari database
    $alurLayananList = preg_split(
        '/\r\n|\r|\n/',
        trim((string) $perizinan->alur_layanan)
    );

    $alurLayananList = array_values(array_filter(
        array_map('trim', $alurLayananList),
        fn ($item) => $item !== ''
    ));
@endphp

<div class="bg-slate-100 min-h-screen py-6 sm:py-10">

    <div class="max-w-6xl mx-auto px-4 sm:px-5 w-full min-w-0">

        <!-- BREADCRUMB -->
        <div class="flex flex-wrap items-center gap-2 text-sm mb-6 break-words">

            <a href="{{ route('beranda') }}"
               class="text-blue-700 hover:underline">
                Beranda
            </a>

            <span class="text-gray-400">›</span>

            <span class="text-blue-700">
                Sektor Perizinan
            </span>

            <span class="text-gray-400">›</span>

            <span class="text-gray-600 break-words">
                {{ $perizinan->nama }}
            </span>

        </div>

        <!-- CONTAINER UTAMA -->
        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 md:p-10
                    w-full min-w-0 overflow-hidden">

            <!-- INFORMASI UTAMA -->
            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-6 md:gap-10 items-center min-w-0">

                <!-- INFORMASI LAYANAN -->
                <div class="min-w-0">

                    <span class="inline-block bg-blue-100 text-blue-700
                                 text-sm font-semibold px-3 py-1
                                 rounded-full mb-4">
                        Sektor Perizinan
                    </span>

                    <h1 class="text-2xl sm:text-3xl md:text-4xl
                               font-bold text-gray-900 mb-5
                               break-words">
                        {{ $perizinan->nama }}
                    </h1>

                    <p class="text-gray-600 leading-relaxed
                              text-justify whitespace-pre-line
                              break-words">
                        {{ $perizinan->deskripsi }}
                    </p>

                </div>

                <!-- GAMBAR -->
                <div class="w-full min-w-0">

                    @if ($perizinan->image &&
                         file_exists(public_path('images/' . $perizinan->image)))

                        <img src="{{ asset('images/' . $perizinan->image) }}"
                             alt="{{ $perizinan->nama }}"
                             class="block w-full max-w-full h-56 sm:h-64
                                    object-cover rounded-xl">

                    @else

                        <div class="w-full max-w-full h-56 sm:h-64
                                    bg-slate-100 rounded-xl
                                    flex flex-col items-center justify-center
                                    text-gray-400">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-12 h-12 mb-2"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M3 16l5-5 4 4 4-6 5 7M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                            </svg>

                            <span class="text-sm">
                                Gambar belum tersedia
                            </span>

                        </div>

                    @endif

                </div>

            </div>

            <!-- PEMBATAS -->
            <div class="border-t border-gray-200 my-8 sm:my-10"></div>

            <!-- PERSYARATAN -->
            <section class="w-full min-w-0">

                <!-- JUDUL PERSYARATAN -->
                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-3 mb-6 min-w-0">

                    <div class="min-w-0">

                        <h2 class="text-xl font-bold text-blue-900">
                            Persyaratan Permohonan
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Informasi persyaratan untuk layanan ini.
                        </p>

                    </div>

                    @if (count($persyaratanList) > 0)

                        <span class="inline-flex self-start sm:self-auto
                                     items-center justify-center
                                     bg-blue-100 text-blue-700 text-sm
                                     font-semibold px-3 py-1 rounded-full
                                     flex-shrink-0">

                            {{ count($persyaratanList) }} Persyaratan

                        </span>

                    @endif

                </div>

                @if (count($persyaratanList) > 0)

                    <!-- DAFTAR PERSYARATAN -->
                    <div class="grid grid-cols-1 sm:grid-cols-2
                                gap-4 w-full min-w-0">

                        @foreach ($persyaratanList as $persyaratan)

                            <div class="flex items-start gap-3 min-w-0
                                        border border-gray-200 rounded-xl p-4
                                        hover:border-blue-300
                                        transition-colors">

                                <!-- IKON -->
                                <div class="flex-shrink-0 w-10 h-10
                                            flex items-center justify-center
                                            bg-blue-50 text-blue-700
                                            rounded-lg">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.8"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />

                                    </svg>

                                </div>

                                <!-- TEKS PERSYARATAN -->
                                <div class="flex-1 min-w-0">

                                    <p class="text-gray-700 leading-relaxed
                                              break-words whitespace-pre-line">
                                        {{ $persyaratan }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    <!-- INFORMASI PERSYARATAN -->
                    <div class="mt-5 flex items-start gap-3
                                bg-blue-50 border border-blue-100
                                rounded-xl p-4 min-w-0">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-blue-600
                                    flex-shrink-0 mt-0.5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 8v4m0 4h.01M10.3 3.9 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3l-7.5-13.1a2 2 0 0 0-3.4 0z"/>

                        </svg>

                        <p class="text-sm text-blue-800 leading-relaxed
                                  break-words min-w-0">
                            Silakan periksa persyaratan dokumen sebelum
                            mengajukan permohonan. Informasi pada prototipe
                            ini merupakan data simulasi dan dapat berbeda
                            dari ketentuan resmi.
                        </p>

                    </div>

                @else

                    <div class="border border-dashed border-gray-300
                                rounded-xl p-6 text-center">

                        <p class="text-gray-500">
                            Informasi persyaratan belum tersedia.
                        </p>

                    </div>

                @endif

            </section>

            <!-- PEMBATAS -->
            <div class="border-t border-gray-200 my-8 sm:my-10"></div>

            <!-- ALUR LAYANAN -->
            <section class="w-full min-w-0">

                <div class="mb-6">

                    <h2 class="text-xl font-bold text-blue-900 mb-2">
                        Alur Layanan
                    </h2>

                    <p class="text-sm text-gray-500 leading-relaxed">
                        Tahapan di bawah merupakan alur simulasi pada
                        prototipe portal. Pelaksanaan layanan resmi dapat
                        mengikuti prosedur instansi yang berlaku.
                    </p>

                </div>

                @if (count($alurLayananList) > 0)

                    <!-- DAFTAR ALUR LAYANAN -->
                    <div class="grid grid-cols-1 sm:grid-cols-2
                                lg:grid-cols-3 xl:grid-cols-4
                                gap-4 w-full min-w-0">

                        @foreach ($alurLayananList as $alur)

                            <div class="min-w-0 h-full text-center
                                        border border-gray-200 rounded-xl
                                        p-4 sm:p-5
                                        hover:border-blue-300
                                        transition-colors">

                                <!-- NOMOR TAHAPAN -->
                                <div class="w-10 h-10 mx-auto
                                            bg-blue-600 text-white
                                            rounded-full flex
                                            items-center justify-center
                                            font-semibold mb-4">

                                    {{ $loop->iteration }}

                                </div>

                                <!-- DESKRIPSI TAHAPAN -->
                                <p class="text-gray-700 leading-relaxed
                                          break-words whitespace-pre-line">
                                    {{ $alur }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                    <!-- INFORMASI ALUR -->
                    <div class="mt-5 bg-blue-50 border border-blue-100
                                rounded-xl p-4 min-w-0">

                        <p class="text-sm text-blue-800 leading-relaxed
                                  break-words">
                            Ikuti tahapan layanan sesuai urutan yang
                            tercantum. Pastikan informasi yang diperlukan
                            telah disiapkan sebelum melanjutkan ke tahap
                            berikutnya.
                        </p>

                    </div>

                @else

                    <div class="border border-dashed border-gray-300
                                rounded-xl p-6 text-center">

                        <p class="text-gray-500">
                            Informasi alur layanan belum tersedia.
                        </p>

                    </div>

                @endif

            </section>

            <!-- PEMBATAS -->
            <div class="border-t border-gray-200 my-8 sm:my-10"></div>

            <!-- TOMBOL KEMBALI -->
            <div class="flex flex-col sm:flex-row
                        justify-between items-stretch sm:items-center
                        gap-4 min-w-0">

                @auth

                    <a href="{{ route('dashboard.user', ['section' => 'sektor']) }}"
                       class="w-full sm:w-auto inline-flex
                              justify-center items-center
                              border border-blue-600 text-blue-700
                              font-semibold px-5 py-3 rounded-lg
                              hover:bg-blue-50 transition">
                        ← Kembali
                    </a>

                @else

                    <a href="{{ route('beranda') }}"
                       class="w-full sm:w-auto inline-flex
                              justify-center items-center
                              border border-blue-600 text-blue-700
                              font-semibold px-5 py-3 rounded-lg
                              hover:bg-blue-50 transition">
                        ← Kembali
                    </a>

                @endauth

            </div>

        </div>

    </div>

</div>

@endsection
