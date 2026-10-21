<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('rental.nama'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-ink antialiased">
    @include('user.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('user.partials.footer')

    {{-- Ikon Lucide (versi dikunci agar tampilan stabil) --}}
    <script src="https://unpkg.com/lucide@0.263.1/dist/umd/lucide.min.js"></script>
    <script>
        lucide.createIcons();

        // Dropdown profil
        const userBtn  = document.getElementById('userMenuBtn');
        const userMenu = document.getElementById('userMenu');
        if (userBtn && userMenu) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const tersembunyi = userMenu.classList.toggle('hidden');
                userBtn.setAttribute('aria-expanded', String(!tersembunyi));
            });
            document.addEventListener('click', () => {
                userMenu.classList.add('hidden');
                userBtn.setAttribute('aria-expanded', 'false');
            });
        }

        // Menu mobile
        const burger    = document.getElementById('burgerBtn');
        const mobileNav = document.getElementById('mobileNav');
        if (burger && mobileNav) {
            burger.addEventListener('click', () => {
                const tersembunyi = mobileNav.classList.toggle('hidden');
                burger.setAttribute('aria-expanded', String(!tersembunyi));
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
