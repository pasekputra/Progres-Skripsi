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
<body class="flex min-h-screen flex-col bg-cream font-sans text-ink antialiased">

    {{--
        Layout halaman masuk & daftar: tanpa navbar dan footer utama.
        Halaman yang memakainya mengisi section:
          - title          : judul tab
          - panel          : isi panel kiri (hanya tampil di layar lebar)
          - panel_catatan  : catatan kecil di dasar panel kiri
          - content        : isi form di sebelah kanan
    --}}
    <div class="relative flex flex-1 flex-col overflow-hidden">

        {{-- Hiasan lingkaran --}}
        <span class="pointer-events-none absolute -top-[70px] left-[8%] z-0 size-[130px] rounded-full border-[25px] border-peach"></span>
        <span class="pointer-events-none absolute -right-[40px] bottom-[60px] z-0 hidden size-[130px] rounded-full border-[25px] border-peach lg:block"></span>

        {{-- Bagian atas: logo + tautan kembali --}}
        <header class="relative z-[1]">
            <x-user.container class="flex h-20 items-center justify-between">
                <a href="{{ route('beranda') }}" class="inline-flex items-center gap-3" aria-label="{{ config('rental.nama') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('rental.nama') }}"
                         class="size-[46px] rounded-full bg-brand object-cover">
                    <span class="flex flex-col leading-[1.15]">
                        <strong class="text-[17px] font-bold">Putri Ayu</strong>
                        <small class="text-[10px] font-bold tracking-[.22em] text-brand-dark">RENT BIKE</small>
                    </span>
                </a>

                <a href="{{ route('beranda') }}"
                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-dark transition hover:text-brand">
                    <i data-lucide="arrow-left" class="size-[18px]"></i> Kembali ke beranda
                </a>
            </x-user.container>
        </header>

        {{-- Kartu utama --}}
        <main class="relative z-[1] flex flex-1 items-center py-6 sm:py-10">
            <x-user.container>
                <div class="mx-auto grid w-full max-w-[980px] overflow-hidden rounded-[28px] border border-line bg-white shadow-[0_24px_48px_rgba(194,87,12,.12)] lg:grid-cols-[.9fr_1.1fr]">

                    {{-- Panel kiri (desktop) --}}
                    <aside class="relative hidden flex-col justify-between overflow-hidden bg-peach p-10 lg:flex">
                        <span class="pointer-events-none absolute -right-14 -top-14 size-52 rounded-full bg-white/35"></span>
                        <span class="pointer-events-none absolute -bottom-16 -left-10 size-44 rounded-full bg-white/25"></span>

                        <div class="relative">
                            @yield('panel')
                        </div>

                        <div class="relative mt-10 text-xs text-brand-dark">
                            @yield('panel_catatan')
                        </div>
                    </aside>

                    {{-- Form --}}
                    <section class="p-6 sm:p-10">
                        @yield('content')
                    </section>
                </div>
            </x-user.container>
        </main>

        <footer class="relative z-[1] py-6 text-center text-xs text-muted">
            &copy; {{ date('Y') }} {{ config('rental.nama') }}
        </footer>
    </div>

    {{-- Ikon Lucide (versi dikunci agar tampilan stabil) --}}
    <script src="https://unpkg.com/lucide@0.263.1/dist/umd/lucide.min.js"></script>
    <script>lucide.createIcons();</script>
    @stack('scripts')
</body>
</html>