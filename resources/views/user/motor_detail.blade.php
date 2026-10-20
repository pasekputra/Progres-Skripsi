@extends('layouts.user_layout')

@section('title', $motor ? $motor->merk . ' ' . $motor->nama . ' | ' . config('rental.nama') : 'Sewa Motor di Bali')

@section('content')

@php
    $kontak      = config('rental.kontak');
    $placeholder = asset('images/placeholder-motor.svg');
    $tahun       = $motor ? ($motor->year ?? $motor->tahun_produksi) : '-';
    $harga       = $motor ? (float) $motor->harga_per_hari : 0;
    $tersedia    = $motor ? $motor->isTersedia() : false;

    $linkWa  = 'https://wa.me/' . $kontak['whatsapp'] . '?text=' . rawurlencode(
        'Halo ' . config('rental.nama') . ', saya ingin menyewa ' . ($motor ? $motor->merk : '') . ' ' . ($motor ? $motor->nama : '') . '.'
    );

    // Tombol sewa: pakai route pemesanan jika sudah ada, sementara arahkan ke WhatsApp
    $linkSewa = $motor ? (Route::has('sewa.create') ? route('sewa.create', $motor->id) : $linkWa) : $linkWa;

    $spesifikasi = [
        ['label' => 'Merk',     'nilai' => $motor ? $motor->merk : '-'],
        ['label' => 'Tahun',    'nilai' => $tahun ?: '-'],
        ['label' => 'Kategori', 'nilai' => $motor ? $motor->kategori->nama : '-'],
        ['label' => 'Status',   'nilai' => $tersedia ? 'Tersedia' : 'Sedang Disewa'],
    ];
@endphp

<div class="relative overflow-hidden bg-cream">
    <span class="pointer-events-none absolute -top-[70px] left-[8%] z-0 size-[130px] rounded-full border-[25px] border-peach"></span>

    <section class="relative z-[1] pb-16 pt-8 sm:pb-24 sm:pt-12">
        <x-user.container>

            {{-- Breadcrumb --}}
            <nav aria-label="Breadcrumb" class="mb-8 flex flex-wrap items-center gap-2 text-[13px] text-muted">
                <a href="{{ route('beranda') }}" class="hover:text-brand-dark">Beranda</a>
                <i data-lucide="chevron-right" class="size-3.5"></i>
                <a href="{{ route('user.motor') }}" class="hover:text-brand-dark">Motor</a>
                <i data-lucide="chevron-right" class="size-3.5"></i>
                <span class="font-medium text-ink">{{ $motor ? $motor->nama : 'Motor' }}</span>
            </nav>

            <div class="grid items-start gap-10 lg:grid-cols-2 lg:gap-14">

                {{-- Gambar --}}
                <div class="relative">
                    <div class="aspect-[4/3] overflow-hidden rounded-[24px] border-8 border-white bg-[#F3E6D8] shadow-[0_24px_48px_rgba(194,87,12,.14)]">
                        <img src="{{ $motor->gambar ? asset('storage/motor/' . $motor->gambar) : $placeholder }}"
                             alt="{{ $motor->merk }} {{ $motor->nama }}"
                             class="size-full object-cover"
                             onerror="this.onerror=null;this.src='{{ $placeholder }}'">
                    </div>

                    @if ($tersedia)
                        <span class="absolute left-6 top-6 inline-flex items-center gap-1.5 rounded-full bg-leaf-tint px-3 py-1.5 text-xs font-semibold text-leaf">
                            <i class="size-1.5 rounded-full bg-leaf"></i>Tersedia
                        </span>
                    @else
                        <span class="absolute left-6 top-6 inline-flex items-center gap-1.5 rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-muted">
                            <i class="size-1.5 rounded-full bg-muted"></i>Sedang Disewa
                        </span>
                    @endif
                </div>

                {{-- Informasi --}}
                <div>
                    <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">
                        {{ $motor->merk }} @if ($motor->kategori) &middot; {{ $motor->kategori->nama }} @endif
                    </p>
                    <h1 class="mb-4 text-[clamp(30px,4vw,44px)] font-normal leading-[1.15] tracking-[-.02em]">{{ $motor->nama }}</h1>

                    <div class="mb-6 flex items-end gap-2">
                        <strong class="text-[32px] font-bold leading-none text-brand-dark">Rp {{ number_format($harga, 0, ',', '.') }}</strong>
                        <small class="pb-1 text-sm text-muted">/ hari</small>
                    </div>

                    @if ($motor->deskripsi)
                        <p class="mb-7 text-[15px] leading-relaxed text-muted">{{ $motor->deskripsi }}</p>
                    @endif

                    {{-- Spesifikasi --}}
                    <dl class="mb-7 grid grid-cols-2 gap-3">
                        @foreach ($spesifikasi as $s)
                            <div class="rounded-xl border border-line bg-white px-4 py-3">
                                <dt class="text-[11px] font-bold uppercase tracking-[.12em] text-brand-dark">{{ $s['label'] }}</dt>
                                <dd class="text-sm font-medium">{{ $s['nilai'] }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    {{-- Estimasi biaya --}}
                    @if ($tersedia)
                        <div class="mb-7 rounded-[18px] border border-[#F9DCC0] bg-peach-soft p-5">
                            <p class="mb-3 text-[13px] font-semibold">Estimasi biaya sewa</p>
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-2.5">
                                    <button type="button" id="hariKurang" aria-label="Kurangi hari"
                                            class="flex size-10 items-center justify-center rounded-xl border border-line bg-white transition hover:border-brand">
                                        <i data-lucide="minus" class="size-4"></i>
                                    </button>
                                    <input id="hari" type="number" min="1" max="30" value="1" inputmode="numeric" aria-label="Lama sewa (hari)"
                                           class="h-10 w-16 rounded-xl border border-line bg-white text-center text-sm font-semibold outline-none focus:border-brand">
                                    <button type="button" id="hariTambah" aria-label="Tambah hari"
                                            class="flex size-10 items-center justify-center rounded-xl border border-line bg-white transition hover:border-brand">
                                        <i data-lucide="plus" class="size-4"></i>
                                    </button>
                                    <span class="text-sm text-muted">hari</span>
                                </div>
                                <div class="text-right">
                                    <small class="block text-[11px] text-muted">Total</small>
                                    <strong id="totalHarga" class="text-xl font-bold text-brand-dark">Rp {{ number_format($harga, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Tombol aksi --}}
                    <div class="flex flex-wrap gap-3">
                        @if ($tersedia)
                            <x-user.button :href="$linkSewa">
                                Sewa Sekarang <i data-lucide="arrow-right" class="size-[18px]"></i>
                            </x-user.button>
                        @else
                            <span class="inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-xl border border-line bg-white px-6 py-3.5 text-sm font-semibold text-muted">
                                Sedang Disewa
                            </span>
                        @endif
                        <x-user.button :href="$linkWa" variant="outline" target="_blank" rel="noopener">
                            <i data-lucide="message-circle" class="size-[18px]"></i> Tanya via WhatsApp
                        </x-user.button>
                    </div>
                </div>
            </div>
        </x-user.container>
    </section>

    {{-- ===================== MOTOR LAINNYA ===================== --}}
    @if ($relatedMotors->isNotEmpty())
        <section class="relative z-[1] border-t border-line bg-peach-soft py-16 sm:py-20">
            <x-user.container>
                <div class="mb-10 flex flex-col items-start gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Pilihan lain</p>
                        <h2 class="text-[clamp(26px,3.2vw,34px)] font-normal leading-[1.2] tracking-[-.02em]">Motor lainnya untukmu</h2>
                    </div>
                    <a href="{{ route('user.motor') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-dark hover:text-brand">
                        Lihat Semua <i data-lucide="arrow-right" class="size-[18px]"></i>
                    </a>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($relatedMotors as $m)
                        <x-user.motor-card :motor="$m" />
                    @endforeach
                </div>
            </x-user.container>
        </section>
    @endif
</div>

@endsection

@push('scripts')
@if ($tersedia)
<script>
    // Estimasi total = harga per hari x jumlah hari
    const hargaPerHari = @json($harga);
    const inputHari = document.getElementById('hari');
    const total     = document.getElementById('totalHarga');

    function hitung() {
        let hari = parseInt(inputHari.value, 10);
        if (isNaN(hari) || hari < 1) hari = 1;
        if (hari > 30) hari = 30;
        inputHari.value = hari;
        total.textContent = 'Rp ' + (hargaPerHari * hari).toLocaleString('id-ID');
    }

    document.getElementById('hariKurang').addEventListener('click', () => { inputHari.value = Number(inputHari.value) - 1; hitung(); });
    document.getElementById('hariTambah').addEventListener('click', () => { inputHari.value = Number(inputHari.value) + 1; hitung(); });
    inputHari.addEventListener('input', hitung);
</script>
@endif
@endpush