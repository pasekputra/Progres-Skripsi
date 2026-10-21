@php
    // Menu navbar. 'aktif' = pola nama route agar menu ikut menyala di halaman turunannya.
    // Jika nama route Anda berbeda, ubah di sini saja.
    $menu = [
        ['label' => 'Beranda', 'route' => 'beranda', 'aktif' => 'beranda'],
['label' => 'Motor', 'route' => 'user.motor', 'aktif' => 'user.motor*'],
        ['label' => 'Tentang', 'route' => 'tentang', 'aktif' => 'tentang'],
        ['label' => 'Kontak',  'route' => 'kontak',  'aktif' => 'kontak'],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-line bg-white">
    <x-user.container class="grid h-20 grid-cols-[auto_1fr] items-center lg:grid-cols-[1fr_auto_1fr]">

        {{-- Logo --}}
        @include('user.partials.brand')

        {{-- Menu tengah (desktop) --}}
        <nav class="hidden gap-9 lg:flex" aria-label="Menu utama">
            @foreach ($menu as $item)
                @php $aktif = request()->routeIs($item['aktif']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="relative py-1.5 text-[15px] transition hover:text-brand-dark {{ $aktif ? 'text-brand after:absolute after:inset-x-0 after:-bottom-1.5 after:h-0.5 after:rounded-sm after:bg-brand' : 'text-ink' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Aksi kanan --}}
        <div class="flex items-center justify-end gap-3.5">
            @auth
                @php
                    $nama     = Auth::user()->nama;
                    $kata     = collect(explode(' ', trim($nama)))->filter();
                    $inisial  = $kata->take(2)->map(fn ($k) => mb_strtoupper(mb_substr($k, 0, 1)))->implode('');
                    $namaDepan = $kata->take(2)->implode(' ');
                    $notifCount = Auth::user()->unreadNotifications()->count();
                @endphp

                {{-- Notifikasi --}}
                <a href="#" aria-label="Notifikasi"
                   class="relative inline-flex size-[42px] items-center justify-center rounded-full border border-line bg-white text-brand-dark transition hover:border-brand">
                    <i data-lucide="bell" class="size-[18px]"></i>
                    @if ($notifCount > 0)
                        <span class="absolute -right-[3px] -top-[3px] flex h-[18px] min-w-[18px] items-center justify-center rounded-full bg-brand px-1 text-[10px] font-bold text-ink">{{ $notifCount }}</span>
                    @endif
                </a>

                {{-- Profil --}}
                <div class="relative">
                    <button type="button" id="userMenuBtn" aria-expanded="false" aria-haspopup="true"
                            class="flex items-center gap-2.5 text-ink">
                        <span class="flex size-10 items-center justify-center rounded-full bg-peach text-[13px] font-bold text-brand-dark">{{ $inisial }}</span>
                        <span class="hidden flex-col text-left leading-tight lg:flex">
                            <small class="text-[11px] text-muted">Halo,</small>
                            <strong class="text-[13px] font-semibold">{{ $namaDepan }}</strong>
                        </span>
                        <i data-lucide="chevron-down" class="size-[18px]"></i>
                    </button>

                    <div id="userMenu"
                         class="absolute right-0 top-[calc(100%+12px)] hidden min-w-[210px] rounded-[14px] border border-line bg-white p-2 shadow-card">
                        <a href="#" class="block w-full rounded-lg px-3 py-2.5 text-left text-sm hover:bg-cream">Riwayat Pembayaran</a>
                        <a href="#" class="block w-full rounded-lg px-3 py-2.5 text-left text-sm hover:bg-cream">Edit Profil</a>
                        <a href="#" class="block w-full rounded-lg px-3 py-2.5 text-left text-sm hover:bg-cream">Ubah Password</a>
                        <form method="POST" action="{{ Route::has('logout') ? route('logout') : '#' }}"
                              class="mt-1.5 border-t border-line pt-1.5">
                            @csrf
                            <button type="submit" class="block w-full rounded-lg px-3 py-2.5 text-left text-sm hover:bg-cream">Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                <x-user.button :href="Route::has('user.auth.login') ? route('user.auth.login') : '#'" variant="outline" size="sm" class="hidden lg:inline-flex">Masuk</x-user.button>
                <x-user.button :href="Route::has('user.auth.register') ? route('user.auth.register') : '#'" size="sm" class="hidden lg:inline-flex">Daftar</x-user.button>
            @endauth

            <button type="button" id="burgerBtn" aria-label="Buka menu" aria-expanded="false"
                    class="inline-flex size-[42px] items-center justify-center rounded-[10px] border border-line bg-white lg:hidden">
                <i data-lucide="menu" class="size-[18px]"></i>
            </button>
        </div>
    </x-user.container>

    {{-- Menu mobile --}}
    <nav id="mobileNav" aria-label="Menu mobile" class="hidden border-t border-line bg-white px-6 pb-5 pt-2 lg:hidden">
        @foreach ($menu as $item)
            @php $aktif = request()->routeIs($item['aktif']); @endphp
            <a href="{{ route($item['route']) }}"
               class="block border-b border-line py-3 {{ $aktif ? 'font-semibold text-brand' : '' }}">
                {{ $item['label'] }}
            </a>
        @endforeach

        @guest
            <div class="mt-4 flex gap-2.5">
                <x-user.button :href="Route::has('user.auth.login') ? route('user.auth.login') : '#'" variant="outline" class="flex-1">Masuk</x-user.button>
                <x-user.button :href="Route::has('user.auth.register') ? route('user.auth.register') : '#'" class="flex-1">Daftar</x-user.button>
            </div>
        @endguest
    </nav>
</header>
