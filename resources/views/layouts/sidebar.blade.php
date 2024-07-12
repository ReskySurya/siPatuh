<!-- resources/views/layouts/sidebar.blade.php -->
<nav id="sidebar" class="bg-[#4A97CD] text-white w-80 min-h-screen p-4">
    <div class="space-y-4">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/airport-security-logo.png') }}" alt="Airport Security Logo" class="w-16 h-16">
            <div class="text-2xl font-bold">Airport Security</div>
        </div>
        <ul class="space-y-2">
            <li>
                @if(Auth::guard('officer')->check())
                    <a href="{{ route('officer.dashboard') }}" class="block py-2 px-4 rounded hover:bg-avseccolor-dark">
                        {{ Auth::guard('officer')->user()->name }}
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-avseccolor-dark">
                        {{ Auth::user()->name }}
                    </a>
                @endif
            </li>
            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-2 px-4 rounded hover:bg-gray-700">
                    <span>Daily Test</span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <ul x-show="open" class="pl-4 space-y-2 mt-2">
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
    <div class="mt-auto pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Logout') }}
            </button>
        </form>
    </div>
</nav>
