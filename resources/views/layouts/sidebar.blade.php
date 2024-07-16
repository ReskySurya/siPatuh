<!-- resources/views/layouts/sidebar.blade.php -->
<div x-data="{ sidebarOpen: true }" class="relative">
     <!-- Sidebar -->
     <nav id="sidebar"
     class="bg-[#4A97CD] text-white min-h-screen transition-all duration-300 ease-in-out overflow-hidden"
     :class="{ 'w-80': sidebarOpen, 'w-20': !sidebarOpen }">
        <!-- Toggle button -->
        <button @click="sidebarOpen = !sidebarOpen"
                class="absolute top-4 -right-3 bg-[#4A97CD] text-white p-1 rounded-full shadow-md hover:bg-[#3A87BD] focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-6 h-6 transition-transform duration-300 ease-in-out"
                :class="{ 'rotate-180': !sidebarOpen }">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <div class="p-4 space-y-4">
            <!-- Logo and title -->
            <div class="flex items-center space-x-3" :class="{ 'justify-center': !sidebarOpen }">
                <img src="{{ asset('images/airport-security-logo.png') }}" alt="Airport Security Logo" class="w-16 h-16">
                <div class="text-2xl font-bold" x-show="sidebarOpen">Airport Security</div>
            </div>

            <!-- Navigation items -->
            <ul class="space-y-2">
                <li>
                    @if(Auth::guard('officer')->check())
                        <a href="{{ route('officer.dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span x-show="sidebarOpen">{{ Auth::guard('officer')->user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 rounded hover:bg-[#3A87BD]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span x-show="sidebarOpen">{{ Auth::user()->name }}</span>
                        </a>
                    @endif
                </li>
                <li x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-[#3A87BD]">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span x-show="sidebarOpen">Daily Test</span>
                        </div>
                        <svg x-show="sidebarOpen" class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="open" class="pl-4 mt-2 space-y-2">
                        <!-- Xray Button -->
                        <li x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-gray-700">
                                <span>Xray</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <ul x-show="open" class="pl-4 space-y-2 mt-2">
                                <li x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-gray-700">
                                        <span>PSCP Cabin</span>
                                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <ul x-show="open" class="pl-4 space-y-2 mt-2">
                                        <li><a href="{{ route('daily-test.x-ray.pscp-cabin-utara') }}" class="block py-2 px-4 rounded hover:bg-gray-700">PSCP Cabin Utara</a></li>
                                        <li><a href="{{ route('daily-test.x-ray.pscp-cabin-selatan') }}" class="block py-2 px-4 rounded hover:bg-gray-700">PSCP Cabin Selatan</a></li>
                                    </ul>
                                </li>
                                <li x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-gray-700">
                                        <span>HBSCP Bagasi</span>
                                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <ul x-show="open" class="pl-4 space-y-2 mt-2">
                                        <li><a href="{{ route('daily-test.x-ray.hbscp-bagasi-barat') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HBSCP Bagasi Barat</a></li>
                                        <li><a href="{{ route('daily-test.x-ray.hbscp-bagasi-timur') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HBSCP Bagasi Timur</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- WTMD Button -->
                        <li x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-gray-700">
                                <span>WTMD</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <ul x-show="open" class="pl-4 space-y-2 mt-2">
                                <li><a href="{{ route('daily-test.wtmd.pos-timur') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Pos Timur</a></li>
                                <li><a href="{{ route('daily-test.wtmd.pscp-utara') }}" class="block py-2 px-4 rounded hover:bg-gray-700">PSCP Utara</a></li>
                                <li><a href="{{ route('daily-test.wtmd.pscp-selatan') }}" class="block py-2 px-4 rounded hover:bg-gray-700">PSCP Selatan</a></li>
                            </ul>
                        </li>

                        <!-- HHMD Button -->
                        <li x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-gray-700">
                                <span>HHMD</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <ul x-show="open" class="pl-4 space-y-2 mt-2">
                                <li><a href="{{ route('daily-test.hhmd.hbscp') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HHMD HBSCP</a></li>
                                <li><a href="{{ route('daily-test.hhmd.pos-timur') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HHMD Pos Timur</a></li>
                                <li><a href="{{ route('daily-test.hhmd.pos-barat') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HHMD Pos Barat</a></li>
                                <li><a href="{{ route('daily-test.hhmd.pscp-utara') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HHMD PSCP Utara</a></li>
                                <li><a href="{{ route('daily-test.hhmd.pscp-selatan') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HHMD PSCP Selatan</a></li>
                                <li><a href="{{ route('daily-test.hhmd.kedatangan') }}" class="block py-2 px-4 rounded hover:bg-gray-700">HHMD Kedatangan</a></li>
                            </ul>
                        </li>
                    </ul>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Logbook Pos Jaga
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Check List CCTV
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Check List Kendaraan
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Sweeping PI
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Laporan Kejadian
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">
                        PM dan IK
                    </a>
                </li>
            </ul>
        </div>
        <!-- Logout button -->
        <div class="absolute bottom-4 left-4 right-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span x-show="sidebarOpen">{{ __('Logout') }}</span>
                </button>
            </form>
        </div>
    </nav>
</div>
