<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Admin Putri Ayu Rent Bike</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-orange-50/40 text-gray-800 antialiased">
    <div class="min-h-screen lg:flex">
        {{-- overlay untuk sidebar di HP --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

        @include('admin.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col">
            @include('admin.partials.topbar')

            <main class="flex-1 p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function setSidebar(open) {
                sidebar.classList.toggle('-translate-x-full', !open);
                overlay.classList.toggle('hidden', !open);
            }

            document.querySelectorAll('[data-sidebar-toggle]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    setSidebar(sidebar.classList.contains('-translate-x-full'));
                });
            });
            overlay.addEventListener('click', function () { setSidebar(false); });

            // Modal konfirmasi
            document.querySelectorAll('[data-modal-open]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const modal = document.getElementById(btn.dataset.modalOpen);
                    if (!modal) return;
                    const form = modal.querySelector('form');
                    if (form && btn.dataset.action) form.action = btn.dataset.action;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });
            document.querySelectorAll('[data-modal-close]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const modal = btn.closest('[data-modal]');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
