@php
    // Ikon (heroicons outline) disimpan sebagai path agar menu mudah ditambah.
    $menu = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard',        'match' => 'admin.dashboard',   'icon' => 'M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75'],
        ['label' => 'Kategori',  'route' => 'admin.kategori.index',   'match' => 'admin.kategori.*',  'icon' => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z'],
        ['label' => 'Motor',     'route' => 'admin.motor.index',      'match' => 'admin.motor.*',     'icon' => 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z'],
        ['label' => 'Transaksi', 'route' => 'admin.transaksi.index',  'match' => 'admin.transaksi.*', 'icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z'],
        ['label' => 'Pelanggan', 'route' => 'admin.pelanggan.index',  'match' => 'admin.pelanggan.*', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
        ['label' => 'Laporan',   'route' => 'admin.laporan.index',    'match' => 'admin.laporan.*',   'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
        ['label' => 'Notifikasi','route' => 'admin.notifikasi.index', 'match' => 'admin.notifikasi.*','icon' => 'M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0'],
    ];
@endphp

<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full transform flex-col border-r border-orange-100 bg-white transition-transform duration-200 lg:static lg:translate-x-0">
    <div class="flex h-16 items-center gap-2 border-b border-orange-100 px-5">
        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-500 font-bold text-white">P</span>
        <div class="leading-tight">
            <p class="text-sm font-bold text-gray-900">Putri Ayu</p>
            <p class="text-xs text-orange-600">Rent Bike Admin</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto p-3">
        @foreach ($menu as $item)
            @php $active = request()->routeIs($item['match']); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                      {{ $active ? 'bg-orange-500 text-white shadow-sm' : 'text-gray-600 hover:bg-orange-50 hover:text-orange-600' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                </svg>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-orange-100 p-3">
        <a href="{{ route('admin.profil.edit') }}"
           class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 hover:bg-orange-50 hover:text-orange-600">
            Profil &amp; Kata Sandi
        </a>
    </div>
</aside>
