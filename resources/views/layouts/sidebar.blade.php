<div x-data="{
    sidebarOpen: window.innerWidth > 768,
    isMobile: window.innerWidth <= 768
}"
x-init="
    window.addEventListener('resize', () => {
        isMobile = window.innerWidth <= 768;
        sidebarOpen = window.innerWidth > 768;
    });
"
class="relative h-screen">
    <!-- Overlay untuk mobile -->
    <div x-show="sidebarOpen && isMobile"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden"></div>

    <!-- Sidebar -->
    <nav id="sidebar"
    class="fixed top-0 left-0 h-full bg-[#4A97CD] text-white transition-all duration-300 ease-in-out z-50"
    :class="{
        'w-80 translate-x-0': sidebarOpen && isMobile,
        'w-80': sidebarOpen && !isMobile,
        'w-20': !sidebarOpen && !isMobile,
        '-translate-x-full': !sidebarOpen && isMobile
    }">
        <!-- Toggle button -->
        <button @click="sidebarOpen = !sidebarOpen"
                class="absolute top-4 -right-3 bg-[#4A97CD] text-white p-1 rounded-full shadow-md hover:bg-[#3A87BD] focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-6 h-6 transition-transform duration-300 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Konten scrollable -->
        <div class="flex-grow overflow-y-auto no-scrollbar">
            <div class="p-4 space-y-4">
                <!-- Logo dan judul -->
                <div class="flex items-center space-x-3" x-show ="sidebarOpen">
                    <img src="{{ asset('images/airport-security-logo.png') }}" alt="Airport Security Logo" class="w-16 h-16">
                    <div class="text-2xl font-bold">Airport Security</div>
                </div>

                <!-- Navigasi -->
                <ul class="space-y-2">
                    <li>
                        @if(Auth::guard('officer')->check())
                            <a href="{{ route('officer.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-[#3A87BD]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span x-show="sidebarOpen" class="ml-3">{{ Auth::guard('officer')->user()->name }}</span>
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-[#3A87BD]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span x-show="sidebarOpen" class="ml-3">{{ Auth::user()->name }}</span>
                            </a>
                        @endif
                    </li>

                    @if(Auth::check() && !Auth::guard('officer')->check() && Auth::user()->role === 'superadmin')
                        <li>
                            <a href="{{ route('masterdata.index') }}" class="flex items-center py-2 px-4 rounded hover:bg-[#3A87BD]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                                <span x-show="sidebarOpen" class="ml-3">Data Master</span>
                            </a>
                        </li>
                    @endif

                    <li x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill ="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                                <span x-show="sidebarOpen" class="ml-3">Daily Test</span>
                            </div>
                            <svg x-show="sidebarOpen" class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul x-show="open" class="pl-4 mt-2 space-y-2">
                            <li x-data="{ openXray: false }">
                                <button @click="openXray = !openXray" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-[#3A87BD]">
                                    <span>X-ray</span>
                                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openXray }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <ul x-show="openXray" class="pl-4 space-y-2 mt-2">
                                    <li><a href="{{ route('daily-test.x-ray.pscp-cabin-utara') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">PSCP Cabin Utara</a></li>
                                    <li><a href="{{ route('daily-test.x-ray.pscp-cabin-selatan') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">PSCP Cabin Selatan</a></li>
                                    <li><a href="{{ route('daily-test.x-ray.hbscp-bagasi-barat') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">HBSCP Bagasi Barat</a></li>
                                    <li><a href="{{ route('daily-test.x-ray.hbscp-bagasi-timur') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">HBSCP Bagasi Timur</a></li>
                                </ul>
                            </li>

                            <li x-data="{ openWTMD: false }">
                                <button @click="openWTMD = !openWTMD" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-[#3A87BD]">
                                    <span>WTMD</span>
                                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': openWTMD }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <ul x-show="openWTMD" class="pl-4 space-y-2 mt-2">
                                    <li><a href="{{ route('daily-test.wtmd.pos-timur') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">Pos Timur</a></li>
                                    <li><a href="{{ route('daily-test.wtmd.pscp-utara') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">PSCP Utara</a></li>
                                    <li><a href="{{ route('daily-test.wtmd.pscp-selatan') }}" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">PSCP Selatan</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('daily-test.hhmd') }}" class="flex items-center py-2 px-4 rounded hover:bg-[#3A87BD]">
                                    <span>HHMD</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">Logbook Pos Jaga</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">Check List CCTV</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0  00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">Check List Kendaraan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">Sweeping PI</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">Laporan Kejadian</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">PM dan IK</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Tombol Logout (ditempatkan di bawah) -->
        <div class="p-4 mt-auto bg-[#4A97CD] bottom-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span x-show="sidebarOpen" class="ml-2">{{ __('Logout') }}</span>
                </button>
            </form>
        </div>
    </nav>
</div>

<script>
    // Tambahkan script untuk mengatur sidebar di mobile
    function handleSidebarOnResize() {
        const sidebar = document.getElementById('sidebar');
        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            sidebar.classList.add('fixed');
        } else {
            sidebar.classList.remove('fixed');
        }
    }

    window.addEventListener('resize', handleSidebarOnResize);
    handleSidebarOnResize(); // Panggil saat pertama kali dimuat
</script>
