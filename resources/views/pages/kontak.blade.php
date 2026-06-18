@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full bg-slate-100">
<div class="max-w-4xl w-full px-4 py-10 mx-auto">
        <!-- Heading -->
        <h2 class="text-3xl font-bold text-blue-700 mb-10 text-left border-b-4 border-orange-500 inline-block pb-2">
            Kontak BP Batam
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Info Kontak -->
            <div class="bg-blue-50 p-8 rounded-2xl shadow">
                <h3 class="text-xl font-semibold text-blue-700 mb-6">Hubungi Kami</h3>
                <ul class="space-y-4 text-gray-700">
                    <li class="flex items-start gap-3">
                        <i class="lucide lucide-map-pin text-blue-600 text-2xl"></i>
                        <span>Jl. Ibnu Sutowo No.1, Batam Centre Batam, Kepulauan Riau, Indonesia, 29400</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="lucide lucide-phone text-blue-600 text-2xl"></i>
                        <span>(0778) 462047</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="lucide lucide-mail text-blue-600 text-2xl"></i>
                        <span>layanan@bpbatam.go.id</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="lucide lucide-clock text-blue-600 text-2xl"></i>
                        <span>Senin – Jumat, 08:00 – 16:00 WIB</span>
                    </li>
                </ul>
            </div>

            <!-- Peta -->
<div class="rounded-2xl overflow-hidden shadow md:sticky md:top-24 h-[400px]">
  <h3 class="bg-blue-700 text-white py-3 px-4 text-lg font-semibold">Lokasi Kami</h3>
  <div id="map" class="h-[350px] w-full"></div>
</div>


<!-- Tambahkan Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  // Koordinat BP Batam (sekitar Batam Centre)
  var bpBatamLat = 1.124;
  var bpBatamLng = 104.048;

  // Inisialisasi map
  var map = L.map('map').setView([bpBatamLat, bpBatamLng], 16);

  // Tambahkan layer OSM
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Tambahkan marker
  var marker = L.marker([bpBatamLat, bpBatamLng]).addTo(map);

  // Popup saat marker diklik
  marker.bindPopup("<b>BP Batam</b><br>Jl. Ibnu Sutowo No.1, Batam Centre, Batam Kepulauan Riau Indonesia");
</script>

        </div>
    </div>
</div>
@endsection
