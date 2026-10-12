@extends('layouts.app')

@section('content')

<div class="bg-slate-100 min-h-screen py-10">

    <div class="max-w-6xl mx-auto px-5">

        <!-- BREADCRUMB -->
        <div class="flex flex-wrap items-center gap-2 text-sm mb-6">
            <a href="{{ route('layanan.index') }}"
               class="text-blue-700 hover:underline">
                Beranda
            </a>

            <span class="text-gray-400">›</span>

            <span class="text-blue-700">
                Izin Usaha Kawasan (IUK)
            </span>

            <span class="text-gray-400">›</span>

            <span class="text-gray-600">
                {{ $layanan->nama }}
            </span>
        </div>


        <!-- SATU CONTAINER PUTIH -->
        <div class="bg-white rounded-xl shadow-sm p-6 md:p-10">


            <!-- ========================= -->
            <!-- INFORMASI UTAMA -->
            <!-- ========================= -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

                <!-- KIRI -->
                <div>

                    <span class="inline-block bg-blue-100 text-blue-700
                                 text-sm font-semibold px-3 py-1 rounded-full mb-4">
                        Izin Usaha Kawasan (IUK)
                    </span>

                    <h1 class="text-3xl md:text-4xl font-bold
                               text-gray-900 mb-5">
                        {{ $layanan->nama }}
                    </h1>

                    <p class="text-gray-600 leading-relaxed
                              text-justify whitespace-pre-line">
                        {{ $layanan->deskripsi }}
                    </p>

                </div>


                <!-- GAMBAR -->
                <div>

                    @if($layanan->image)

                        <img src="{{ asset('images/'.$layanan->image) }}"
                             alt="{{ $layanan->nama }}"
                             class="w-full h-64 object-cover rounded-xl">

                    @else

                        <img src="{{ asset('images/default.png') }}"
                             alt="Default Image"
                             class="w-full h-64 object-cover rounded-xl">

                    @endif

                </div>

            </div>


            <!-- GARIS -->
            <div class="border-t border-gray-200 my-10"></div>


          

<!-- ========================= -->
<!-- PERSYARATAN -->
<!-- ========================= -->

<div>
    <div class="flex flex-col sm:flex-row sm:items-center
                justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl font-bold text-blue-900">
                Persyaratan Permohonan
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Dokumen yang perlu dipersiapkan untuk layanan ini.
            </p>
        </div>

        @php
            $daftarPersyaratan = preg_split(
                '/\r\n|\r|\n/',
                trim($layanan->persyaratan ?? ''),
                -1,
                PREG_SPLIT_NO_EMPTY
            );
        @endphp

        <span class="inline-flex items-center gap-2 bg-blue-50
                     text-blue-700 border border-blue-100
                     px-3 py-2 rounded-lg text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h6m-6 4h6M9 4h6l4 4v12H5V4h4z"/>
            </svg>

            {{ count($daftarPersyaratan) }} dokumen
        </span>
    </div>

    @if(count($daftarPersyaratan) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($daftarPersyaratan as $persyaratan)
                <div class="group flex items-start gap-4 p-4
                            bg-white border border-gray-200
                            rounded-xl shadow-sm
                            hover:border-blue-300 hover:shadow-md
                            transition duration-200">

                    <div class="flex-shrink-0 w-11 h-11
                                flex items-center justify-center
                                rounded-xl bg-blue-50 text-blue-600
                                group-hover:bg-blue-600
                                group-hover:text-white transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.7">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8 7h8M8 11h8M8 15h5M6 3h9l4 4v14H6V3z"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold
                                  text-gray-800 leading-relaxed">
                            {{ trim($persyaratan) }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Dokumen persyaratan layanan
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="border border-dashed border-gray-300
                    rounded-xl p-6 text-center">
            <p class="text-sm text-gray-500">
                Persyaratan dokumen belum tersedia untuk layanan ini.
            </p>
        </div>
    @endif

    <div class="mt-5 flex items-start gap-3 bg-blue-50
                border border-blue-100 rounded-xl p-4">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 8v4m0 4h.01M10.3 3.9 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3l-7.5-13.1a2 2 0 0 0-3.4 0z"/>
        </svg>

        <p class="text-sm text-blue-800 leading-relaxed">
            Silakan periksa persyaratan dokumen sebelum mengajukan
            permohonan. Informasi pada prototipe ini merupakan data
            simulasi dan dapat berbeda dari ketentuan resmi.
        </p>
    </div>
</div>
            <!-- GARIS -->
            <div class="border-t border-gray-200 my-10"></div>


<!-- ========================= -->
<!-- ALUR PERMOHONAN -->
<!-- ========================= -->

<div>
    <div class="mb-8">
        <h2 class="text-xl font-bold text-blue-900">
            Alur Permohonan
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Tahapan pelayanan untuk layanan yang dipilih.
        </p>
    </div>

    @php
        $daftarAlur = preg_split(
            '/\r\n|\r|\n/',
            trim($layanan->alur_layanan ?? ''),
            -1,
            PREG_SPLIT_NO_EMPTY
        );
    @endphp

    @if(count($daftarAlur) > 0)
        <div class="relative">
            <!-- Garis penghubung pada desktop -->
            <div class="hidden md:block absolute top-6
                        left-[10%] right-[10%]
                        border-t-2 border-dashed border-blue-200">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2
                        md:grid-cols-5 gap-6 relative">

                @foreach($daftarAlur as $index => $alur)
                    <div class="relative flex md:flex-col
                                items-start md:items-center
                                gap-4 md:gap-0 text-left md:text-center">

                        <!-- Nomor tahap -->
                        <div class="relative z-10 flex-shrink-0
                                    w-12 h-12 rounded-full
                                    bg-blue-600 text-white
                                    flex items-center justify-center
                                    font-bold text-lg
                                    shadow-md ring-4 ring-white">
                            {{ $index + 1 }}
                        </div>

                        <div class="md:mt-4 flex-1 min-w-0
                                    md:min-h-[100px]">

                            <span class="inline-block text-xs
                                         font-semibold text-blue-700
                                         bg-blue-50 px-2 py-1
                                         rounded-md mb-2">
                                Tahap {{ $index + 1 }}
                            </span>

                            <p class="text-sm font-semibold
                                      text-gray-800 leading-relaxed
                                      whitespace-pre-line">
                                {{ trim($alur) }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @else
        <div class="border border-dashed border-gray-300
                    rounded-xl p-6 text-center">
            <p class="text-sm text-gray-500">
                Alur layanan belum tersedia.
            </p>
        </div>
    @endif

    <div class="mt-8 bg-gray-50 border border-gray-200
                rounded-xl p-4">
        <div class="flex items-start gap-3">
            <div class="w-9 h-9 flex-shrink-0
                        flex items-center justify-center
                        rounded-lg bg-white border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-blue-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 8v4l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                </svg>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-800">
                    Informasi alur pelayanan
                </p>

                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Tahapan di atas merupakan alur simulasi pada prototipe
                    portal. Pelaksanaan layanan resmi dapat mengikuti
                    prosedur instansi yang berlaku.
                </p>
            </div>
        </div>
    </div>
</div>




            <!-- GARIS -->
            <div class="border-t border-gray-200 my-10"></div>


            <!-- ========================= -->
            <!-- TOMBOL -->
            <!-- ========================= -->

            <div class="flex flex-col sm:flex-row
                        justify-between items-center gap-4">

                <!-- KEMBALI -->
                @auth
    <a href="{{ route('dashboard.user', ['section' => 'iuk']) }}"
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
        <!-- END CONTAINER PUTIH -->


    </div>

</div>

@endsection