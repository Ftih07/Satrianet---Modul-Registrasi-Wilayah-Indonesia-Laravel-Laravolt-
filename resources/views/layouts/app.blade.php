<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Satrianet')</title>

    <!-- TailwindCSS (atau link ke file CSS kamu sendiri) -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="py-4 bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Satrianet</h1>
            <nav>
                <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Beranda</a>
            </nav>
        </div>
    </header>

    <!-- Konten -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-20 py-6 border-t">
        <div class="text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Satrianet. All rights reserved.
        </div>
    </footer>

</body>
</html>
