<footer class="bg-blue-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-6">

        <!-- ================= MOBILE ================= -->
        <div class="block md:hidden">

            <!-- Kolom 1 -->
            <div class="mb-6">
                <img src="{{ asset('images/logoiboss.png') }}"
                     alt="Logo BP Batam"
                     class="mb-4 w-20">

                <p class="text-sm leading-relaxed">
                    Portal Layanan BP Batam merupakan sistem digital yang menyediakan
                    informasi layanan dan mendukung proses permohonan perizinan secara elektronik.
                </p>
            </div>

            <!-- Kolom 2, 3, 4 -->
            <div class="grid grid-cols-3 gap-4 text-xs">

                <!-- Navigasi -->
                <div>
                    <h3 class="font-semibold text-sm mb-2">Navigasi</h3>

                    <ul class="space-y-1">
                        <li>
                            <a href="{{ url('/') }}" class="hover:underline">
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/faq') }}" class="hover:underline">
                                FAQ
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/kontak') }}" class="hover:underline">
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Informasi -->
                <div>
                    <h3 class="font-semibold text-sm mb-2">Informasi</h3>

                    <ul class="space-y-1">
                        <li>Kebijakan Privasi</li>
                        <li>Syarat & Ketentuan</li>
                        <li>Peta Situs</li>
                    </ul>

                    <h4 class="font-semibold text-sm mt-2 mb-1">
                        Media Sosial
                    </h4>

                    <div class="flex items-center space-x-2">

                        <!-- Facebook -->
                        <a href="https://web.facebook.com/badanpengusahaanbatam?locale=id_ID"
                           target="_blank"
                           rel="noopener noreferrer">

                            <img src="{{ asset('images/fb.png') }}"
                                 alt="Facebook BP Batam"
                                 class="w-5 h-5 cursor-pointer hover:scale-110 transition-transform duration-200">
                        </a>

                        <!-- Twitter -->
                        <img src="{{ asset('images/twitter.png') }}"
                             alt="Twitter"
                             class="w-5 h-5">

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/bpbatam?utm_source=ig_web_button_share_sheet&igsi=ZDNlZDc0MzIxNw=="
                           target="_blank"
                           rel="noopener noreferrer">

                            <img src="{{ asset('images/instagram.png') }}"
                                 alt="Instagram BP Batam"
                                 class="w-5 h-5 cursor-pointer hover:scale-110 transition-transform duration-200">
                        </a>

                        <!-- YouTube -->
                        <a href="https://www.youtube.com/@BPBATAMBIFZA"
                           target="_blank"
                           rel="noopener noreferrer">

                            <img src="{{ asset('images/youtube.png') }}"
                                 alt="YouTube BP Batam"
                                 class="w-5 h-5 cursor-pointer hover:scale-110 transition-transform duration-200">
                        </a>

                    </div>
                </div>

                <!-- Hubungi Kami -->
                <div>
                    <h3 class="font-semibold text-sm mb-2">
                        Hubungi Kami
                    </h3>

                    <p class="text-xs mb-2">
                        Jl. Ibnu Sutowo No.1, Batam Centre<br>
                        Batam, Kepulauan Riau, Indonesia, 29400
                    </p>

                    <p class="text-xs">
                        (62-778) 462047, 462048
                    </p>
                </div>

            </div>
        </div>


        <!-- ================= DESKTOP ================= -->
        <div class="hidden md:grid md:grid-cols-4 gap-8">

            <!-- Kolom 1 -->
            <div>
                <img src="{{ asset('images/logoiboss.png') }}"
                     alt="Logo BP Batam"
                     class="mb-4 w-20">

                <p class="text-sm leading-relaxed">
                    Portal Layanan BP Batam merupakan sistem digital yang menyediakan
                    informasi layanan dan mendukung proses permohonan perizinan secara elektronik.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div class="md:border-l md:border-white/40 md:pl-6">
                <div class="mx-auto text-left w-fit">

                    <h3 class="font-semibold text-lg mb-3">
                        Navigasi
                    </h3>

                    <ul class="space-y-1">
                        <li>
                            <a href="{{ url('/') }}" class="hover:underline">
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/faq') }}" class="hover:underline">
                                FAQ
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/kontak') }}" class="hover:underline">
                                Kontak
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Kolom 3 -->
            <div class="md:border-l md:border-white/40 md:pl-6">
                <div class="mx-auto text-left w-fit">

                    <h3 class="font-semibold text-lg mb-3">
                        Informasi
                    </h3>

                    <ul class="space-y-1">
                        <li>Kebijakan Privasi</li>
                        <li>Syarat & Ketentuan</li>
                        <li>Peta Situs</li>
                    </ul>

                    <h4 class="font-semibold text-sm mt-2 mb-1">
                        Media Sosial
                    </h4>

                    <div class="flex items-center gap-3">

                        <!-- Facebook -->
                        <a href="https://web.facebook.com/badanpengusahaanbatam?locale=id_ID"
                           target="_blank"
                           rel="noopener noreferrer">

                            <img src="{{ asset('images/fb.png') }}"
                                 alt="Facebook BP Batam"
                                 class="w-5 h-5 cursor-pointer hover:scale-110 transition-transform duration-200">
                        </a>

                        <!-- Twitter -->
                        <img src="{{ asset('images/twitter.png') }}"
                             alt="Twitter"
                             class="w-5 h-5">

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/bpbatam?utm_source=ig_web_button_share_sheet&igsi=ZDNlZDc0MzIxNw=="
                           target="_blank"
                           rel="noopener noreferrer">

                            <img src="{{ asset('images/instagram.png') }}"
                                 alt="Instagram BP Batam"
                                 class="w-5 h-5 cursor-pointer hover:scale-110 transition-transform duration-200">
                        </a>

                        <!-- YouTube -->
                        <a href="https://www.youtube.com/@BPBATAMBIFZA"
                           target="_blank"
                           rel="noopener noreferrer">

                            <img src="{{ asset('images/youtube.png') }}"
                                 alt="YouTube BP Batam"
                                 class="w-5 h-5 cursor-pointer hover:scale-110 transition-transform duration-200">
                        </a>

                    </div>

                </div>
            </div>

            <!-- Kolom 4 -->
            <div class="md:border-l md:border-white/40 md:pl-6 text-left">

                <h3 class="font-semibold text-lg mb-3">
                    Hubungi Kami
                </h3>

                <p class="text-sm mb-3">
                    Jl. Ibnu Sutowo No.1, Batam Centre<br>
                    Batam, Kepulauan Riau, Indonesia, 29400
                </p>

                <p class="text-sm">
                    (62-778) 462047, 462048
                </p>

            </div>

        </div>


        <!-- Copyright -->
        <div class="mt-10 border-t border-white/40 pt-4 text-center text-sm text-gray-300">
            &copy; copyright by
            <span class="text-yellow-400 font-semibold">BPBatam</span>
        </div>

    </div>
</footer>