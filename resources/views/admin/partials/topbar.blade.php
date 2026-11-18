@php
    // Data contoh. Nanti ganti dengan data dari controller / auth()->user().
    $adminNama = 'Admin Putri Ayu';
    $notifBelumDibaca = 3;
@endphp

<header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-orange-100 bg-white/90 px-4 backdrop-blur sm:px-6">
    <button type="button" data-sidebar-toggle class="rounded-lg p-2 text-gray-600 hover:bg-orange-50 lg:hidden" aria-label="Buka menu">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
        </svg>
    </button>

    <p class="hidden text-sm text-gray-500 lg:block">Panel Admin</p>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.notifikasi.index') }}" class="relative rounded-full p-2 text-gray-600 hover:bg-orange-50" aria-label="Notifikasi">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            @if ($notifBelumDibaca > 0)
                <span class="absolute -right-0.5 -top-0.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[10px] font-bold text-white">{{ $notifBelumDibaca }}</span>
            @endif
        </a>

        <a href="{{ route('admin.profil.edit') }}" class="flex items-center gap-2 rounded-full py-1 pl-1 pr-3 hover:bg-orange-50">
            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-orange-500 text-sm font-bold text-white">
                {{ strtoupper(substr($adminNama, 0, 1)) }}
            </span>
            <span class="hidden text-sm font-medium text-gray-700 sm:block">{{ $adminNama }}</span>
        </a>
    </div>
</header>
