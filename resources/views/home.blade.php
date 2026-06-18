@extends('layouts.app')

@section('content')

<style>
/* --- IBOSS-like hero adjustments --- */
/* Pastikan background.jpg adalah gambar yang sudah benar */
.hero-section {
    background: url('{{ asset('images/background.jpg') }}') no-repeat center center;
    background-size: cover;
    padding: 40px 0 20px 0;  
}

.hero-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 80px;
}

.hero-text {
    flex: 1 1 50%;
    max-width: 50%;
    padding-top: 0px;
    margin-top: -20px;
    margin-bottom: 28px;
}

.hero-text h1 {
    font-size: 3.6rem;
    font-weight: 800;
    color: #0056d2;
    margin: 0 0 18px 0;
    line-height: 1.02;
    letter-spacing: 1;
    font-family: "Poppins", "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

.hero-text p.sub-title {
    font-size: 1.2rem;
    margin: 0 0 10px 0;
    color: rgba(255,255,255,0.95);
    font-weight: 500;
    letter-spacing: 2;
    margin-bottom: 16px;
}

.hero-text p.description {
    font-size: 1.3rem;
    line-height: 1.5;
    color: #ffffff;
    font-weight: 600;
    margin: 0;
    max-width: 600px;
}

.hero-buttons {
    margin-top: 28px;
}

.hero-buttons .btn-primary {
    background-color: #0056d2;
    color: #fff;
    font-weight: 700;
    border: none;
    padding: 14px 28px;
    font-size: 1rem;
    border-radius: 8px;
}

.hero-search input {
    background-color: #fff;
    color: #6b7280;
    padding: 12px;
    font-size: 1rem;
    width: 100%;
    max-width: 420px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    margin-top: 24px;
}

.hero-search button {
    position: absolute;
    right: 10px;
    top: 80%;
    transform: translateY(-48%);
}

.hero-image {
    flex: 1 1 40%;
    max-width: 40%;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-image img {
    max-width: 100%;
    height: auto;
    display: block;
}

/* RESPONSIVE */
@media (max-width: 1200px) {
    .hero-container { padding: 0 40px; }
    .hero-text h1 { font-size: 3.2rem; }
}

@media (max-width: 992px) {
    .hero-container { padding: 0 28px; }
    .hero-text h1 { font-size: 2.8rem; }
    .hero-text p.description { max-width: 100%; }
}

@media (max-width: 768px) {
    .hero-text, .hero-image {
        max-width: 100%;
        text-align: center;
    }
    .hero-container {
        flex-direction: column-reverse;
        padding: 0 20px;
    }
    .hero-text h1 { font-size: 2.2rem; margin-bottom: 12px; }
    .hero-text p.sub-title { font-size: 1rem; }
    .hero-text p.description { font-size: 0.98rem; line-height: 1.6; }
    .hero-search { margin-top: 18px; }
}

.scrolled {
    background-color: white !important;
    border-bottom: 1px solid #e5e7eb !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
</style>

<section class="hero-section">
    <div class="hero-container">
        <div class="hero-text">
            <h1>PERIZINAN Batam</h1>
            <p class="sub-title">Indonesia Batam Online Single Submission</p>
            <p class="description">
                Sistem aplikasi perizinan secara elektronik yang terintegrasi dengan sistem Online Single Submission Nasional di wilayah Kawasan Perdagangan Bebas dan Pelabuhan Bebas (KPBPB) Batam.
            </p>

            @auth
            <div class="hero-buttons mt-8">
                <a href="#" class="btn btn-primary pointer-events-none cursor-default">
                    Jelajahi Layanan/Perizinan
                </a>
            </div>

            <form action="{{ route('layanan.search') }}" method="GET" class="relative max-w-sm mt-6 hero-search">
                <input type="text" name="q"
                    value="{{ request('q') }}"
                    class="w-full p-3 pr-12 bg-white text-gray-600 placeholder-gray-400 rounded shadow-md focus:outline-none"
                    placeholder="Cari di sini...">
                <button type="submit" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center justify-center text-blue-500 cursor-pointer hover:text-blue-700 transition leading-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </button>
            </form>
            @endauth
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/hero-ilustration.png') }}" alt="Ilustrasi Layanan">
        </div>
    </div>
</section>

<!-- LAYANAN UNGGULAN -->
<section id="layanan-unggulan" class="mt-12 bg-slate-200 py-10 mb-20"> 
  <h4 class="text-2xl font-bold text-center text-orange-500 mb-6">
    Izin Usaha Kawasan (IUK)
  </h4>

  <div class="relative">
    <!-- Tombol Navigasi -->
    <button id="unggulan-prev" 
        class="absolute left-0 top-1/2 -translate-y-1/2 bg-orange-500 text-white p-2 rounded-full shadow z-10 hover:bg-orange-600">
        &lt;
    </button>
    <button id="unggulan-next" 
        class="absolute right-0 top-1/2 -translate-y-1/2 bg-orange-500 text-white p-2 rounded-full shadow z-10 hover:bg-orange-600">
        &gt;
    </button>

    <!-- Wrapper Card -->
    <div id="unggulan-scroll" class="flex overflow-x-auto space-x-4 scroll-smooth hide-scrollbar px-6">
        @forelse ($layanans as $index => $l)
            <div class="flex-shrink-0 bg-white rounded-2xl shadow-lg p-5 w-72 sm:w-64 md:w-1/4 flex flex-col justify-start hover:shadow-xl transition-all duration-300">
                <h4 class="text-lg font-semibold text-blue-700 mb-2 text-center">{{ $l->nama }}</h4>
                <p class="text-sm text-gray-600 text-center mb-3 line-clamp-2 min-h-[40px]">
    {{ $l->deskripsi }}
</p>
<img src="{{ $l->image
                ? asset('images/'.$l->image)
                : asset('images/layanan_'.(($index % 6) + 1).'.png') }}"
     class="w-full h-40 object-cover rounded mt-3 mb-4">
                <a href="{{ route('layanan.show', $l->id) }}" 
                   class="mt-auto bg-orange-500 text-white text-center py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-200">
                    Lihat Detail
                </a>
            </div>
        @empty
            <p class="text-center text-gray-500">Belum ada layanan</p>
        @endforelse
    </div>
  </div>
</section>

<script>
const scrollContainer = document.getElementById('unggulan-scroll');
const prevBtn = document.getElementById('unggulan-prev');
const nextBtn = document.getElementById('unggulan-next');
if(scrollContainer && prevBtn && nextBtn) {
    const scrollAmount = scrollContainer.offsetWidth / 2;
    prevBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    nextBtn.addEventListener('click', () => {
        scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
}
</script>

<script>
document.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
</script>

<style>
/* LAYANAN UNGGULAN RESPONSIVE */
#unggulan-scroll {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 16px;
    -webkit-overflow-scrolling: touch;
}
#unggulan-scroll > div {
    flex: 0 0 auto;
    scroll-snap-align: start;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>

<section class="mt-12 bg-slate-200 py-12 mb-20">
    <h4 class="text-2xl font-bold text-center text-orange-500">
        Sektor Perizinan 
    </h4>
    @php
        $perizinans = $perizinans->sortBy('id'); // ubah ke sortByDesc kalau mau terbaru di atas
    @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 px-10">
    @forelse ($perizinans as $index => $p)
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center">
            <h4 class="text-lg font-semibold text-blue-700">{{ $p->nama }}</h4>
            <p class="text-sm text-gray-600 mt-2">{{ $p->deskripsi }}</p>
            <img src="{{ $p->image
             ? asset('images/'.$p->image)
             : asset('images/perizinan'.(($index % 3) + 1).'.png') }}"
                 class="w-64 h-40 object-cover rounded mt-4 mx-auto">
            <a href="{{ route('perizinan.show', $p->id) }}" 
               class="block mt-3 bg-orange-500 text-white text-center py-2 px-6 rounded font-semibold hover:bg-orange-600">
                Lihat Detail
            </a>
        </div>
    @empty
        <p class="text-center text-gray-500">Belum ada perizinan</p>
    @endforelse
    </div>
</section>

@endsection
