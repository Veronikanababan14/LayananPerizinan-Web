<nav id="navbar" class="fixed top-0 left-0 w-full z-50 bg-white shadow ">
  <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
    <!-- Logo -->
    <a href="/" class="flex items-center space-x-3">
      <img src="{{ asset('images/logoiboss.png') }}" alt=""  class="h-17 -mt-1">
    </a>

    <!-- Hamburger (Mobile) -->
    <button type="button" class="md:hidden inline-flex items-center justify-center p-2 w-10 h-10 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
      onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>

    <!-- Menu Desktop -->
    <div class="hidden md:flex w-full items-center relative">
      <ul class="flex space-x-8 font-medium text-lg absolute left-1/2 transform -translate-x-1/2 -mt-2">
        <li><a href="{{ route('beranda') }}" class="text-blue-700 font-bold hover:underline">Beranda</a></li>

        

        <li><a href="{{ route('faq') }}" class="text-blue-700 font-bold hover:underline">FAQ</a></li>
        <li><a href="{{ route('kontak') }}" class="text-blue-700 font-bold hover:underline">Kontak</a></li>
      </ul>

      <!-- Right Menu -->
      <ul class="flex space-x-4 font-medium text-lg ml-auto mr-16">
        @guest
          <li>
            <a href="{{ route('login') }}" 
               class="px-3 py-1.5 bg-orange-500 text-white font-bold rounded-lg shadow hover:bg-orange-600 transition duration-300">
               Login
            </a>
          </li>
          <!-- Sign Up dihapus dari navbar utama untuk guest -->
        @endguest

        @auth
          @if(auth()->user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="text-green-600 font-bold hover:underline">Admin Dashboard</a></li>
            <li>
              <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-red-600 font-bold hover:underline">Logout</button>
              </form>
            </li>
          @else
            <!-- Profile Dropdown (Desktop) -->
            <li class="relative">
              <button id="user-btn" class="flex items-center px-3 py-1.5 bg-blue-700 text-white font-bold rounded-lg shadow hover:bg-blue-800 focus:outline-none transition text-sm">
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                  </svg>
                  {{ auth()->user()->name }}
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                  </svg>
              </button>

              <ul id="user-dropdown" class="absolute right-0 mt-2 hidden bg-white border border-gray-200 shadow-lg rounded-lg w-48 z-50">
                  <li>
        <a href="{{ route('profile.settings') }}"
   class="flex items-center gap-3 px-2 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">

    <img src="{{ asset('images/face-icon.png') }}" 
         class="w-5 h-5 object-contain" alt="Profile Icon">

    Profile
</a>

    </li>
                  <li>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
        class="flex items-center gap-3 px-2 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"
            class="w-5 h-5">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
        </svg>

        Logout
    </button>
</form>


    </li>
              </ul>
            </li>
          @endif
        @endauth
      </ul>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 shadow-md">
    <ul class="flex flex-col p-4 space-y-2 font-medium">
      <li><a href="{{ route('beranda') }}" class="text-blue-700 font-bold">Beranda</a></li>

      <!-- Mobile Dropdown Layanan -->
      

      <li><a href="{{ route('faq') }}" class="text-blue-700 font-bold">FAQ</a></li>
      <li><a href="{{ route('kontak') }}" class="text-blue-700 font-bold">Kontak</a></li>

            @guest
        <li>
          <a href="{{ route('login') }}" 
             class="block text-center px-5 py-2 bg-orange-500 text-white font-bold rounded-lg shadow hover:bg-orange-600 transition duration-300">
             Login
          </a>
        </li>
        <!-- Sign Up dihapus dari mobile menu guest -->
      @endguest


      @auth
        @if(auth()->user()->role === 'admin')
          <li><a href="{{ route('admin.dashboard') }}" class="text-green-600 font-bold">Admin Dashboard</a></li>
          <li>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button type="submit" class="text-red-600 font-bold">Logout</button>
            </form>
          </li>
        @else
          <!-- Profile Dropdown (Mobile) -->
          <li class="relative">
            <button id="mobile-user-btn" class="flex items-center px-3 py-1.5 bg-blue-700 text-white font-bold rounded-lg shadow hover:bg-blue-800 transition text-sm w-full justify-between">
              <div class="flex items-center">
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                  </svg>
                  {{ auth()->user()->name }}
              </div>
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            <ul id="mobile-user-dropdown" 
    class="mt-2 hidden flex-col space-y-1 bg-white border border-gray-200 rounded-lg shadow-lg">

    <!-- Mobile Profile -->
    <li>
        <a href="{{ route('profile.settings') }}"
           class="flex items-center gap-2 px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">

            <!-- Ikon PNG -->
            <img src="{{ asset('images/face-icon.png') }}" 
                 class="w-5 h-5 object-contain" alt="Profile Icon">

            Profile
        </a>
    </li>

    <!-- Mobile Logout -->
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 px-2 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left">

                <!-- SVG Logout -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="w-5 h-5">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>

                Logout
            </button>
        </form>
    </li>

</ul>
          </li>
        @endif
      @endauth
    </ul>
  </div>
</nav>


<!-- Dropdown JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
   

    // Desktop user dropdown
    const userBtn = document.getElementById('user-btn');
    const userMenu = document.getElementById('user-dropdown');
    if(userBtn) {
        userBtn.addEventListener('click', () => userMenu.classList.toggle('hidden'));
    }

    // Mobile user dropdown
    const mobileUserBtn = document.getElementById('mobile-user-btn');
    const mobileUserMenu = document.getElementById('mobile-user-dropdown');
    if(mobileUserBtn) {
        mobileUserBtn.addEventListener('click', () => mobileUserMenu.classList.toggle('hidden'));
    }

    // Klik di luar dropdown untuk menutup
    document.addEventListener('click', (e) => {
        if(userBtn && !userBtn.contains(e.target) && !userMenu.contains(e.target)) {
            userMenu.classList.add('hidden');
        }
        if(mobileUserBtn && !mobileUserBtn.contains(e.target) && !mobileUserMenu.contains(e.target)) {
            mobileUserMenu.classList.add('hidden');
        }
    });
});

// 👇 Tambahin ini di luar DOMContentLoaded
document.addEventListener("scroll", function() {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("bg-white", "shadow");
    } else {
        navbar.classList.remove("bg-white", "shadow");
    }
});
</script>
