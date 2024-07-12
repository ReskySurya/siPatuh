<!-- resources/views/layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <main class="min-h-screen flex items-center justify-center">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
