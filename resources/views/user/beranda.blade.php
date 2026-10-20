@extends('layouts.user_layout')

@section('title', 'Putri Ayu Rent Bike | Sewa Motor di Bali')

@section('content')

@php
    $kontak = config('rental.kontak');

    $langkah = [
        ['no' => '01', 'icon' => 'search',        'judul' => 'Pilih Motor',   'isi' => 'Temukan motor yang sesuai gaya perjalananmu.'],
        ['no' => '02', 'icon' => 'calendar-days', 'judul' => 'Pilih Tanggal', 'isi' => 'Tentukan tanggal mulai dan selesai sewa.'],
        ['no' => '03', 'icon' => 'calendar-days', 'judul' => 'Login', 'isi' => 'Buat akun atau login untuk memudahkan proses sewa.'],
        ['no' => '04', 'icon' => 'credit-card',   'judul' => 'Bayar Online',  'isi' => 'Pembayaran aman dengan berbagai pilihan.'],
        ['no' => '05', 'icon' => 'key',           'judul' => 'Ambil Motor',   'isi' => 'Ambil di lokasi atau hubungi kami untuk diantar.'],
    ];

    // Teks keunggulan ini dari desain. Pastikan sesuai layanan asli Anda.
    $keunggulan = [
        ['icon' => 'wrench',     'judul' => 'Garansi Servis',    'isi' => 'Unit selalu dicek dan diservis berkala.'],
        ['icon' => 'hard-hat',   'judul' => 'Gratis 2 Helm',     'isi' => 'Helm bersih dan aman untuk perjalananmu.'],
        ['icon' => 'package',    'judul' => 'Antar Jemput',      'isi' => 'Hubungi kami untuk layanan antar ke lokasimu.'],
        ['icon' => 'headphones', 'judul' => 'Layanan Setiap Hari', 'isi' => 'Tim kami siap membantu pukul ' . sprintf('%02d.00–%02d.00', $kontak['jam_buka'], $kontak['jam_tutup']) . ' WIB.'],
    ];

    $placeholder = asset('images/placeholder-motor.svg');
@endphp

{{-- ===================== HERO ===================== --}}
<section class="overflow-hidden bg-cream pb-14 pt-10 sm:pb-20 sm:pt-[72px]">
    <x-user.container class="grid items-center gap-10 lg:grid-cols-[1.05fr_.95fr] lg:gap-16">

        <div>
            <div class="mb-7 inline-flex items-center gap-2 rounded-full border border-line bg-white py-1.5 pl-1.5 pr-3.5 text-xs font-semibold">
                <span class="flex h-6 overflow-hidden rounded-full">
                    <i class="block h-6 w-[18px] bg-leaf"></i>
                    <i class="block h-6 w-[18px] bg-[#E8A870]"></i>
                    <i class="block h-6 w-[18px] bg-[#A9805F]"></i>
                </span>
                <i data-lucide="map-pin" class="size-3.5 text-brand"></i>
                <span>Rental motor di Tabanan, Bali</span>
            </div>

            <h1 class="mb-6 text-[clamp(38px,5.2vw,66px)] font-normal leading-[1.12] tracking-[-.03em]">
                Sewa Motor di Bali,
                <span class="relative z-0 text-brand after:absolute after:inset-x-0 after:bottom-0.5 after:-z-10 after:h-2 after:rounded after:bg-[#FDD9B5]">Mudah</span>
                dan Terpercaya
            </h1>

            <p class="mb-8 max-w-[500px] text-base text-muted">
                Temukan motor terbaik untuk menjelajahi setiap sudut Bali. Harga transparan,
                unit terawat, dan proses sewa tanpa ribet.
            </p>

            <div class="mb-11 flex flex-wrap gap-3">
                <x-user.button :href="route('user.motor')" variant="primary">
                    Lihat Motor <i data-lucide="arrow-right" class="size-[18px]"></i>
                </x-user.button>
                <x-user.button href="#cara-menyewa" variant="outline">Cara Menyewa</x-user.button>
            </div>

            {{-- Angka diambil dari database --}}
            <dl class="flex">
                <div class="pr-4 sm:pr-7">
                    <dt class="text-[22px] font-semibold leading-tight">{{ $totalMotor }}</dt>
                    <dd class="text-xs text-muted">Unit Motor</dd>
                </div>
                <div class="border-l border-line px-4 sm:px-7">
                    <dt class="text-[22px] font-semibold leading-tight">{{ $totalTersedia }}</dt>
                    <dd class="text-xs text-muted">Siap Disewa</dd>
                </div>
                <div class="border-l border-line px-4 sm:px-7">
                    <dt class="text-[22px] font-semibold leading-tight">{{ sprintf('%02d–%02d', $kontak['jam_buka'], $kontak['jam_tutup']) }}</dt>
                    <dd class="text-xs text-muted">Jam Layanan (WIB)</dd>
                </div>
            </dl>
        </div>

        <div class="relative mx-auto w-full max-w-[460px] py-6 sm:pl-10 lg:max-w-none">
            <span class="absolute -right-[60px] top-0 z-0 size-60 rounded-full bg-[#FFE3C8] sm:-right-[90px] sm:size-[360px]"></span>
            <span class="absolute bottom-0 left-[18%] z-0 size-[100px] rounded-full bg-[#D6E8D0]"></span>

            <div class="relative z-[1] aspect-[4/4.4] rotate-[1deg] overflow-hidden rounded-[200px_200px_28px_28px] border-8 border-white bg-peach shadow-[0_24px_48px_rgba(194,87,12,.14)]">
                <img src="{{ asset('images/logo.png') }}" alt="Suasana jalan di Bali dengan motor sewaan"
                     class="size-full object-cover" onerror="this.style.display='none'">
            </div>

            <div class="absolute left-0 top-[18%] z-[2] flex items-center gap-3 rounded-[14px] bg-white px-[18px] py-3 shadow-[0_12px_28px_rgba(0,0,0,.1)] sm:-left-2">
                <i data-lucide="shield-check" class="size-[18px] text-brand"></i>
                <div>
                    <strong class="block text-[13px] font-semibold leading-snug">Aman &amp; Terawat</strong>
                    <small class="text-[11px] text-muted">Servis berkala</small>
                </div>
            </div>
            <div class="absolute bottom-[16%] right-0 z-[2] flex items-center gap-3 rounded-[14px] bg-white px-[18px] py-3 shadow-[0_12px_28px_rgba(0,0,0,.1)] sm:-right-3">
                <span class="flex size-[34px] items-center justify-center rounded-full bg-leaf-tint text-leaf">
                    <i data-lucide="check" class="size-[18px]"></i>
                </span>
                <div>
                    <strong class="block text-[13px] font-semibold leading-snug">Siap untuk kamu</strong>
                    <small class="text-[11px] text-muted">Proses sewa mudah</small>
                </div>
            </div>
        </div>
    </x-user.container>
</section>

{{-- ===================== MOTOR PILIHAN ===================== --}}
<section class="bg-cream pb-16 pt-8 sm:pb-24 sm:pt-12">
    <x-user.container>
        <div class="mb-10 flex flex-col items-start gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Siap disewa</p>
                <h2 class="mb-2 text-[clamp(28px,3.4vw,38px)] font-normal leading-[1.2] tracking-[-.02em]">Motor Pilihan</h2>
                <p class="text-[15px] text-muted">Unit terbaru yang tersedia untuk menemani keliling Bali.</p>
            </div>
            <a href="{{ route('user.motor') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-dark hover:text-brand">
                Lihat Semua <i data-lucide="arrow-right" class="size-[18px]"></i>
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($motors as $m)
                <article class="overflow-hidden rounded-[20px] border border-line bg-white shadow-card transition hover:-translate-y-[3px] hover:shadow-[0_14px_32px_rgba(194,87,12,.14)]">
                    <div class="relative h-[236px] bg-[#F3E6D8]">
                        <img src="{{ $m->gambar ? asset('storage/motor/' . $m->gambar) : $placeholder }}"
                             alt="{{ $m->merk }} {{ $m->nama }}" loading="lazy"
                             class="size-full object-cover"
                             onerror="this.onerror=null;this.src='{{ $placeholder }}'">

                        @if ($m->isTersedia())
                            <span class="absolute left-3.5 top-3.5 inline-flex items-center gap-1.5 rounded-full bg-leaf-tint px-2.5 py-1 text-[11px] font-semibold text-leaf">
                                <i class="size-1.5 rounded-full bg-leaf"></i>Tersedia
                            </span>
                        @else
                            <span class="absolute left-3.5 top-3.5 inline-flex items-center gap-1.5 rounded-full bg-white px-2.5 py-1 text-[11px] font-semibold text-muted">
                                <i class="size-1.5 rounded-full bg-muted"></i>Sedang Disewa
                            </span>
                        @endif
                    </div>

                    <div class="px-5 pb-5 pt-[18px]">
                        <div class="mb-1.5 flex items-center justify-between">
                            <span class="text-[11px] font-bold uppercase tracking-[.12em] text-brand-dark">{{ $m->merk }}</span>
                            <span class="rounded-lg bg-peach-soft px-2.5 py-1 text-[11px] font-semibold text-brand-dark">{{ $m->year }}</span>
                        </div>
                        <h3 class="mb-1 text-xl font-medium tracking-[-.01em]">{{ $m->nama }}</h3>
                        <p class="text-xs text-muted">{{ $m->kategori->nama ?? '-' }}</p>

                        <div class="mt-[18px] flex items-center justify-between border-t border-line pt-4">
                            <div>
                                <strong class="block text-[17px] font-bold leading-tight text-brand-dark">Rp {{ number_format((float) $m->harga_per_hari, 0, ',', '.') }}</strong>
                                <small class="text-[11px] text-muted">/ hari</small>
                            </div>
                            <x-user.button :href="route('user.motor.detail', $m->id)" variant="outline" size="sm">Lihat Detail</x-user.button>
                        </div>
                    </div>
                </article>
            @empty
                <p class="col-span-full py-10 text-center text-muted">Belum ada motor yang tersedia saat ini.</p>
            @endforelse
        </div>
    </x-user.container>
</section>

{{-- ===================== CARA MENYEWA ===================== --}}
<section id="cara-menyewa" class="py-16 sm:py-24">
    <x-user.container>
        <div class="mb-10 text-center">
            <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Mudah &amp; cepat</p>
            <h2 class="mb-2 text-[clamp(28px,3.4vw,38px)] font-normal leading-[1.2] tracking-[-.02em]">Cara Menyewa</h2>
            <p class="text-[15px] text-muted">Hanya empat langkah sederhana, motormu siap menemani perjalanan.</p>
        </div>

        <ol class="isolate flex flex-wrap items-start justify-center gap-x-2 gap-y-7 sm:flex-nowrap">
            @foreach ($langkah as $s)
                <li class="basis-[calc(50%-8px)] text-center sm:max-w-[250px] sm:flex-1 sm:basis-0">
                    <div class="relative mx-auto mb-[18px] flex size-[68px] items-center justify-center rounded-[24px_26px_22px_28px] bg-peach text-brand-dark">
                        <span class="absolute -left-[22px] -top-3.5 -z-10 text-[26px] font-bold leading-none text-[#F8C9A0]">{{ $s['no'] }}</span>
                        <i data-lucide="{{ $s['icon'] }}" class="size-[26px]"></i>
                    </div>
                    <h3 class="mb-1 text-base font-medium">{{ $s['judul'] }}</h3>
                    <p class="text-[12.5px] text-muted">{{ $s['isi'] }}</p>
                </li>
                @if (! $loop->last)
                    <li class="hidden pt-[22px] text-[#E8B68C] sm:block" aria-hidden="true">
                        <i data-lucide="chevron-right" class="size-[18px]"></i>
                    </li>
                @endif
            @endforeach
        </ol>
    </x-user.container>
</section>

{{-- ===================== KENAPA KAMI ===================== --}}
<section class="bg-cream py-16 sm:py-24">
    <x-user.container class="grid items-center gap-9 lg:grid-cols-[.9fr_1.1fr] lg:gap-16">
        <div>
            <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Kenapa kami?</p>
            <h2 class="mb-3 text-[clamp(28px,3.4vw,38px)] font-normal leading-[1.2] tracking-[-.02em]">Jelajah Bali dengan tenang</h2>
            <p class="mb-7 max-w-[420px] text-[15px] text-muted">Kami memastikan setiap perjalananmu terasa aman dan menyenangkan, sejak pemesanan hingga motor kembali.</p>
            <x-user.button :href="route('tentang')">
                Kenali Kami <i data-lucide="arrow-right" class="size-[18px]"></i>
            </x-user.button>
        </div>

        <div class="grid gap-[18px] sm:grid-cols-2">
            @foreach ($keunggulan as $k)
                <div class="rounded-[18px] border border-[#F9DCC0] bg-peach-soft p-6">
                    <span class="mb-[18px] flex size-[42px] items-center justify-center rounded-xl bg-white text-brand-dark">
                        <i data-lucide="{{ $k['icon'] }}" class="size-[18px]"></i>
                    </span>
                    <h3 class="mb-1 text-base font-medium">{{ $k['judul'] }}</h3>
                    <p class="text-[12.5px] text-muted">{{ $k['isi'] }}</p>
                </div>
            @endforeach
        </div>
    </x-user.container>

    {{-- Banner ajakan --}}
    <x-user.container>
        <div class="relative mt-14 flex flex-col items-start justify-between gap-6 overflow-hidden rounded-[28px] border border-[#F9DCC0] bg-peach px-6 py-8 after:pointer-events-none after:absolute after:-right-[50px] after:-top-[60px] after:size-[220px] after:rounded-full after:bg-white/35 sm:mt-[88px] sm:flex-row sm:items-center sm:px-14 sm:py-12 *:relative *:z-10">
            <div>
                <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Waktunya berpetualang</p>
                <h2 class="mb-2 text-[clamp(28px,3.4vw,38px)] font-normal leading-[1.2] tracking-[-.02em]">Siap menjelajahi Bali?</h2>
                <p class="text-[15px] text-muted">Pilih motor favoritmu dan mulai perjalanan yang tak terlupakan.</p>
            </div>
            <x-user.button :href="route('user.motor')">
                Pilih Motor Sekarang <i data-lucide="arrow-right" class="size-[18px]"></i>
            </x-user.button>
        </div>
    </x-user.container>
</section>

@endsection
