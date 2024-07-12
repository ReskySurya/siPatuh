<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'siPatuh')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        @include('layouts.sidebar')
        <div class="flex flex-col flex-1">
            <!-- Navbar -->
            <nav class="bg-[#66B82E] text-white p-6">
                <div class="container mx-auto">
                    <form class="flex items-center">
                        <input type="text" placeholder="Search..." class="px-4 py-2 w-64 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-white text-gray-800">
                        <button type="submit" class="bg-white text-[#66B82E] px-6 py-2 rounded-r-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Main content area -->
            <main class="flex-1 p-10 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
