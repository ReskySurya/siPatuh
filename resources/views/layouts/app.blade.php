<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'siPatuh')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tambahkan meta tags untuk mobile responsiveness -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tambahkan link ke stylesheet kustom -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Script dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body class="bg-gray-100 antialiased">
    <div class="flex min-h-screen overflow-hidden">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            <!-- Navbar dengan mobile responsiveness -->
            <nav class="bg-[#66B82E] text-white p-4">
                <div class="container mx-auto">
                    <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2">
                        <div class="flex w-full sm:w-auto">
                            <input type="text" placeholder="Search..."
                                class="flex-1 px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-white text-gray-800">
                            <button type="submit"
                                class="bg-white text-[#66B82E] px-4 py-2 rounded-r-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main content area dengan padding dan responsivitas lanjut -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200
                xs:p-4 sm:p-6 md:p-8 lg:p-10
                min-h-screen
                max-w-full
                w-full
                mx-auto
                transition-all
                duration-300
                ease-in-out">

                <!-- Wrapper untuk konten dengan batasan maksimal lebar -->
                <div class="w-full
                    max-w-full
                    md:max-w-screen-xl
                    lg:max-w-screen-2xl
                    mx-auto
                    sm:px-4
                    md:px-6
                    lg:px-8">

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    @yield('scripts')
</body>

</html>
