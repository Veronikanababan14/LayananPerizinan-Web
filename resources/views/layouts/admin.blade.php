<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

          <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Alpine.js (untuk dropdown) -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 text-gray-900">

<div class="flex min-h-screen">

    <!-- 🔵 SIDEBAR -->
    <aside id="sidebar"
           class="fixed top-0 left-0 w-56 h-full max-h-screen overflow-y-auto bg-blue-800 text-white shadow-md p-6 z-[9999]
              transform -translate-x-full md:translate-x-0 transition-all duration-300">
                  

        <!-- 📌 Header Mobile (Logo kiri + X kanan) -->
        <div class="flex items-center justify-between mb-4 md:hidden">
            <img src="{{ asset('images/logoiboss.png') }}" class="w-16" alt="Logo">
            <button onclick="hideSidebar()" class="text-white text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Logo (Desktop Only) -->
        <div class="hidden md:flex items-center justify-center mb-6">
            <img src="{{ asset('images/logoiboss.png') }}"
                 class="w-20 mx-auto block"
                 alt="Logo">
        </div>

        <!-- Garis halus -->
        <div class="border-b border-white/30 my-4"></div>

        <ul class="space-y-2 list-none">

    <!-- Dashboard -->
    <li>
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 py-2 px-3 hover:bg-blue-900 rounded text-sm">
            <img src="{{ asset('images/dashboard-icon.png') }}" class="w-6 h-6 object-contain" alt="">
            <span>Dashboard</span>
        </a>
    </li>
<!-- IUK (SINGLE MENU) -->
<li>
    <a href="{{ route('admin.iuk.index') }}"
       class="flex items-center gap-3 py-2 px-3 hover:bg-blue-900 rounded text-sm">

        <img src="{{ asset('images/iuk-icon.png') }}" class="w-6 h-6 object-contain">

        <div class="flex flex-col leading-tight">
            <span class="font-semibold">Izin Usaha Kawasan</span>
            
        </div>
    </a>
</li>

    <!-- Sektor Perizinan -->
    <li>
    <a href="{{ route('admin.perizinan.index') }}"
       class="flex items-center gap-3 py-2 px-3 hover:bg-blue-900 rounded text-sm cursor-pointer">

        <img src="{{ asset('images/sk-icon.png') }}"
             class="w-6 h-6 object-contain">

        <span>Sektor Perizinan</span>
    </a>
</li>
                
            </li>
        </ul>
    </li>
    <a href="{{ route('admin.pengajuan.index') }}"
   class="flex items-center gap-3 px-3 py-2 hover:bg-blue-900 rounded text-sm">
    <i class="fa-solid fa-inbox text-lg"></i>
    Pengajuan Masuk
</a>

    <!-- Users -->
     <ul class="list-none">
    <li>
        <a href="{{ route('admin.users') }}"
           class="flex items-center gap-3 py-2 px-3 hover:bg-blue-900 rounded text-sm">
            <img src="{{ asset('images/users-icon.png') }}" class="w-6 h-6 object-contain" alt="">
            <span>Users</span>
        </a>
    </li>

</ul>
    </aside>

    <!-- 🔵 OVERLAY (Mobile) -->
    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black bg-opacity-40 z-40 hidden md:hidden"
         onclick="hideSidebar()">
    </div>

    <!-- 🔵 MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-h-screen bg-gray-100
                ml-0 md:ml-56 transition-all duration-300">

        <!-- NAVBAR -->
<nav class="fixed top-0 left-0 md:left-56 right-0 h-16 
     bg-white shadow flex items-center justify-between px-4 z-40">

    <!-- BAGIAN KIRI (Hamburger + Title + Tanggal) -->
    <div class="flex items-center gap-4">

        <button class="md:hidden text-xl" onclick="showSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="flex flex-col">
            <!-- Perkecil tulisan Dashboard di mobile -->
            <h2 class="text-base md:text-xl font-semibold">Dashboard</h2>

            <p class="text-xs text-gray-500">
                <span id="todayDate"></span>
            </p>
        </div>

    </div>

    <!-- BAGIAN KANAN -->
<div class="flex items-center gap-3">

    @php
        $initial = strtoupper(substr(auth()->user()->name, 0, 1));
        $notif_admin_count = \App\Models\Pengajuan::where('dibaca_admin', false)->count();

        $notif_admin_list = \App\Models\Pengajuan::with(['user', 'layanan'])
            ->latest()
            ->take(10)
            ->get();
    @endphp

    <!-- NOTIFIKASI ADMIN -->
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open; if(open) markAllRead()"
            class="relative p-2 rounded-full border border-gray-200 hover:bg-gray-100 transition">
            <i class="fa-regular fa-bell text-gray-600 text-lg"></i>

            @if($notif_admin_count > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">
                    {{ $notif_admin_count > 9 ? '9+' : $notif_admin_count }}
                </span>
            @endif
        </button>

        <!-- DROPDOWN NOTIFIKASI -->
        <div x-show="open" x-transition x-cloak
            class="absolute right-0 mt-2 w-80 bg-white rounded-xl border border-gray-200 shadow-xl z-50 overflow-hidden">

            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800 text-sm">Notifikasi</h3>
                <span class="text-xs text-gray-400">Admin</span>
            </div>

            <div class="max-h-72 overflow-y-auto divide-y divide-gray-100">
                @forelse($notif_admin_list as $item)
                    <a href="{{ route('admin.notifikasi.baca', $item->id) }}"
                        class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition">

                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-file-lines text-blue-600 text-xs"></i>
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">Pengajuan Baru Masuk</p>
                            <p class="text-xs text-gray-500 mt-0.5 truncate">
                                {{ $item->layanan->nama ?? '-' }} — {{ $item->user->name ?? '-' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $item->created_at->diffForHumans() }}
                            </p>
                        </div>

                        @if(!$item->dibaca_admin)
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        @endif
                    </a>
                @empty
                    <div class="px-4 py-8 text-center">
                        <i class="fa-regular fa-bell-slash text-gray-300 text-3xl mb-2 block"></i>
                        <p class="text-sm text-gray-400">Belum ada pengajuan</p>
                    </div>
                @endforelse
            </div>

            <div class="px-4 py-3 border-t border-gray-100 text-center">
                <a href="{{ route('admin.pengajuan.index') }}"
                    class="text-xs text-blue-600 hover:underline font-medium">
                    Lihat semua pengajuan
                </a>
            </div>
        </div>
    </div>

    <!-- PROFILE ADMIN -->
    <div class="relative" x-data="{ open:false }">
        <button @click="open = !open"
            class="flex items-center gap-2 px-3 py-1.5 border border-gray-300 rounded-full text-sm whitespace-nowrap hover:bg-gray-100 transition">

            <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center text-sm font-bold">
                {{ $initial }}
            </div>

            <span class="text-gray-700 hidden sm:inline">
                {{ auth()->user()->name }}
            </span>

            <i class="fa-solid fa-chevron-down text-xs text-gray-500"></i>
        </button>

        <!-- DROPDOWN PROFILE -->
        <div x-show="open" x-transition x-cloak
            class="absolute right-0 mt-2 w-44 bg-white shadow-lg rounded-lg border border-gray-300 z-50">

            <a href="{{ route('admin.profile.edit') }}"
                class="flex items-center gap-2 px-3 py-2 text-sm hover:bg-gray-100">
                <img src="{{ asset('images/face-icon.png') }}" class="w-4 h-4 object-contain">
                <span>Edit Profile</span>
            </a>

            <a href="{{ route('admin.profile.password.form') }}"
                class="flex items-center gap-2 px-3 py-2 text-sm hover:bg-gray-100">
                <img src="{{ asset('images/pass-icon.png') }}" class="w-4 h-4 object-contain">
                <span>Change Password</span>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex w-full items-center gap-2 px-3 py-2 text-sm text-rose-600 hover:bg-gray-100 font-semibold">
                    <i class="fa-solid fa-right-from-bracket w-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

</div>
</nav>

        <!-- CONTENT -->
        <main class="px-3 md:px-6 py-4 mt-20">
            @yield('content')
        </main>
    </div>

</div>

<!-- Script Sidebar -->
<script>
    function showSidebar() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('sidebarOverlay').classList.remove('hidden');
    }

    function hideSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebarOverlay').classList.add('hidden');
    }

    // Menampilkan hari dan tanggal Indonesia
    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('todayDate').textContent = today.toLocaleDateString('id-ID', options);

    function markAllRead() {
    fetch('{{ route("admin.notifikasi.readAll") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(() => {
        // Hilangkan badge
        const badge = document.querySelector('.bg-red-500.rounded-full');
        if (badge) badge.remove();

        // Hilangkan titik biru semua item
        document.querySelectorAll('.bg-blue-500.rounded-full').forEach(el => el.remove());
    });
}
</script>

</body>
</html>
