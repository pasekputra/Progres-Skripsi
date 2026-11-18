<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Masuk Admin') - Putri Ayu Rent</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-orange-50/50 text-gray-800 antialiased flex items-center justify-center min-h-screen selection:bg-orange-500 selection:text-white">
    
    <div class="w-full max-w-md p-4 sm:p-6">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>