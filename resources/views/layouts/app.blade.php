<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ublog') }}</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-7xl mx-auto flex justify-between">
            <a href="{{ route('home') }}" class="font-bold text-xl">ublog</a>
            @auth
                <a href="{{ route('profile') }}">Profil</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-5xl mx-auto p-4">
        @yield('content')
    </main>

    @vite('resources/js/app.js')
</body>
</html>
