@extends('layouts.user_layout')

@section('title', 'Tentang Kami | ' . config('rental.nama'))

@section('content')

@php
    $stats  = $data['stats'];
    $kontak = $data['kontak'];
    $tahunBerdiri = config('rental.tahun_berdiri');

    // Nilai-nilai usaha (silakan ubah teksnya)
    $nilai = [
        ['icon' => 'shield-check', 'judul' => 'Terpercaya',   'isi' => 'Harga jujur, tanpa biaya tersembunyi.'],
        ['icon' => 'heart',        'judul' => 'Sepenuh Hati', 'isi' => 'Pelayanan hangat khas Bali.'],
    ];

    // Angka pada pita hijau (dari $data['stats'] dan config/rental.php)
    $angka = [
        ['nilai' => number_format($stats['pelanggan'], 0, ',', '.') . '+', 'label' => 'Pelanggan Bahagia'],
        ['nilai' => $stats['motor'] . '+',                                 'label' => 'Unit Motor Terawat'],
        ['nilai' => sprintf('%02d–%02d', $kontak['jam_buka'], $kontak['jam_tutup']), 'label' => 'Jam Layanan Setiap Hari (WIB)'],
    ];
@endphp

<div class="relative overflow-hidden bg-cream">

    {{-- Hiasan lingkaran --}}
    <span class="pointer-events-none absolute -top-[70px] left-[8%] z-0 size-[130px] rounded-full border-[25px] border-peach"></span>
    <span class="pointer-events-none absolute right-[3%] top-[205px] z-0 hidden size-[130px] rounded-full border-[25px] border-peach lg:block"></span>

    {{-- ===================== HEADER ===================== --}}
    <section class="relative z-[1] border-b border-line bg-peach-soft px-6 py-14 text-center sm:py-[72px]">
        <p class="mb-3 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Cerita Kami</p>
        <h1 class="mb-3 text-[clamp(30px,4vw,44px)] font-normal leading-[1.2] tracking-[-.02em]">
            Perjalanan nyaman dimulai dari kepercayaan
        </h1>
        <p class="mx-auto max-w-[560px] text-sm text-muted">
            Melayani perjalanan wisatawan di Bali dengan sepenuh hati sejak {{ $tahunBerdiri }}.
        </p>
    </section>

    {{-- ===================== CERITA ===================== --}}
    <section class="relative z-[1] py-16 sm:py-24">
        <x-user.container class="grid items-center gap-14 lg:grid-cols-2 lg:gap-16">

            {{-- Foto + lencana --}}
            <div class="relative mx-auto w-full max-w-[495px] pb-6 pl-0 sm:pl-8">
                <div class="aspect-[495/480] overflow-hidden rounded-[100px_16px_16px_16px] bg-peach shadow-[0_24px_48px_rgba(194,87,12,.14)]">
                    <img src="{{ asset('images/tentang.jpg') }}" alt="Jalan asri di Bali dengan pengendara motor"
                         class="size-full object-cover" onerror="this.style.display='none'">
                </div>

                <div class="absolute -bottom-0 left-0 w-40 rounded-2xl bg-brand px-4 py-6 text-center shadow-[0_12px_28px_rgba(194,87,12,.25)]">
                    <strong class="block text-[28px] font-bold leading-none text-ink">{{ $stats['pengalaman'] }}+</strong>
                    <small class="mt-2 block text-[10px] leading-snug text-ink">Tahun menemani perjalananmu</small>
                </div>
            </div>

            {{-- Teks --}}
            <div>
                <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">{{ config('rental.nama') }}</p>
                <h2 class="mb-5 text-[clamp(28px,3.4vw,38px)] font-normal leading-[1.2] tracking-[-.02em]">Lebih dari sekadar rental motor</h2>

                {{-- Cerita ini contoh. Ganti dengan sejarah asli usaha Anda. --}}
                <p class="mb-4 text-sm leading-relaxed text-muted">
                    Kami berawal dari usaha rental kecil di Tabanan, Bali, dengan satu tujuan sederhana:
                    membantu wisatawan menikmati Bali dengan lebih leluasa. Kini, kami bangga telah
                    menjadi teman perjalanan bagi ratusan wisatawan.
                </p>
                <p class="mb-7 text-sm leading-relaxed text-muted">
                    Setiap motor dirawat seperti milik sendiri. Setiap pelanggan disambut seperti keluarga.
                    Karena bagi kami, perjalanan yang baik dimulai dari rasa aman dan pelayanan yang tulus.
                </p>

                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach ($nilai as $n)
                        <div class="flex items-center gap-3.5 rounded-xl border border-line bg-white px-4 py-3.5">
                            <i data-lucide="{{ $n['icon'] }}" class="size-6 text-brand"></i>
                            <div>
                                <strong class="block text-[13px] font-semibold leading-snug">{{ $n['judul'] }}</strong>
                                <small class="text-[11px] text-muted">{{ $n['isi'] }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-user.container>
    </section>

    {{-- ===================== ANGKA ===================== --}}
    <section class="relative z-[1] bg-leaf py-12 text-white sm:py-14">
        <x-user.container class="grid grid-cols-2 gap-y-8 lg:grid-cols-4">
            @foreach ($angka as $a)
                <div class="px-4 text-center {{ $loop->first ? '' : 'lg:border-l lg:border-white/20' }} {{ $loop->index % 2 === 1 ? 'border-l border-white/20' : '' }}">
                    <strong class="block text-[clamp(26px,3vw,34px)] font-semibold leading-tight">{{ $a['nilai'] }}</strong>
                    <small class="mt-1 block text-[11px] font-medium opacity-90">{{ $a['label'] }}</small>
                </div>
            @endforeach
        </x-user.container>
    </section>
</div>

@endsection