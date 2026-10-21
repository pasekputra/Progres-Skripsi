@extends('layouts.user_layout')

@section('title', 'Daftar Motor | ' . config('rental.nama'))

@section('content')

@php
    $opsiUrut = [
        'terbaru'  => 'Terbaru',
        'termurah' => 'Harga Termurah',
        'termahal' => 'Harga Termahal',
    ];

    // Link kategori: pertahankan pencarian & urutan yang sedang dipakai
    $linkKategori = fn ($id = null) => route('user.motor', array_filter([
        'search'   => $search !== '' ? $search : null,
        'sort'     => $sort !== 'terbaru' ? $sort : null,
        'kategori' => $id,
    ]));

    $adaFilter  = $search !== '' || $kategoriId;
    $inputKelas = 'w-full rounded-xl border border-line bg-white px-4 py-3 text-sm outline-none transition placeholder:text-muted/70 focus:border-brand focus:ring-2 focus:ring-brand/30';
@endphp

<div class="relative overflow-hidden bg-cream">

    {{-- Hiasan lingkaran --}}
    <span class="pointer-events-none absolute -top-[70px] left-[8%] z-0 size-[130px] rounded-full border-[25px] border-peach"></span>

    {{-- ===================== HEADER ===================== --}}
    <section class="relative z-[1] border-b border-line bg-peach-soft px-6 py-12 text-center sm:py-16">
        {{-- <p class="mb-3 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">user.motor</p> --}}
        <h1 class="mb-3 text-[clamp(30px,4vw,44px)] font-normal leading-[1.2] tracking-[-.02em]">Pilih motor untuk perjalananmu</h1>
        <p class="mx-auto max-w-[560px] text-sm text-muted">Cari berdasarkan nama atau merk, lalu urutkan sesuai kebutuhanmu.</p>
    </section>

    <section class="relative z-[1] pb-16 pt-10 sm:pb-24">
        <x-user.container>

            {{-- ===================== PENCARIAN & FILTER ===================== --}}
            <form method="GET" action="{{ route('user.motor') }}"
                  class="grid gap-3 rounded-[20px] border border-line bg-white p-4 shadow-card sm:grid-cols-[1fr_auto] lg:grid-cols-[1fr_210px_auto]">
                @if ($kategoriId)
                    <input type="hidden" name="kategori" value="{{ $kategoriId }}">
                @endif

                <div class="relative sm:col-span-2 lg:col-span-1">
                    <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 size-[18px] -translate-y-1/2 text-muted"></i>
                    <input type="search" name="search" value="{{ $search }}" maxlength="60"
                           placeholder="Cari nama atau merk motor…" class="{{ $inputKelas }} pl-11">
                </div>

                <select name="sort" onchange="this.form.submit()" aria-label="Urutkan" class="{{ $inputKelas }}">
                    @foreach ($opsiUrut as $nilai => $label)
                        <option value="{{ $nilai }}" @selected($sort === $nilai)>{{ $label }}</option>
                    @endforeach
                </select>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-6 py-3 text-sm font-semibold text-ink shadow-[0_6px_16px_rgba(245,130,32,.28)] transition hover:bg-brand-hover">
                    <i data-lucide="search" class="size-[18px]"></i> Cari
                </button>
            </form>

            {{-- Kategori --}}
            @if ($daftarKategori->isNotEmpty())
                <div class="mt-5 flex flex-wrap gap-2.5">
                    <a href="{{ $linkKategori() }}"
                       class="rounded-full border px-4 py-2 text-[13px] font-medium transition {{ $kategoriId ? 'border-line bg-white hover:border-brand' : 'border-brand bg-brand text-ink' }}">
                        Semua
                    </a>
                    @foreach ($daftarKategori as $k)
                        <a href="{{ $linkKategori($k->id) }}"
                           class="rounded-full border px-4 py-2 text-[13px] font-medium transition {{ (string) $kategoriId === (string) $k->id ? 'border-brand bg-brand text-ink' : 'border-line bg-white hover:border-brand' }}">
                            {{ $k->nama }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Ringkasan hasil --}}
            <div class="mb-6 mt-8 flex flex-wrap items-center justify-between gap-3 text-sm text-muted">
                @if ($motors->total() > 0)
                    <p>Menampilkan <strong class="text-ink">{{ $motors->firstItem() }}–{{ $motors->lastItem() }}</strong>
                       dari <strong class="text-ink">{{ $motors->total() }}</strong> motor</p>
                @else
                    <p>Tidak ada motor ditemukan</p>
                @endif

                @if ($adaFilter)
                    <a href="{{ route('user.motor') }}" class="inline-flex items-center gap-1.5 font-semibold text-brand-dark hover:text-brand">
                        <i data-lucide="x" class="size-4"></i> Reset filter
                    </a>
                @endif
            </div>

            {{-- ===================== DAFTAR MOTOR ===================== --}}
            @if ($motors->isNotEmpty())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($motors as $motor)
                        <x-user.motor-card :motor="$motor" />
                    @endforeach
                </div>

                <div class="mt-12">
                   {{ $motors->links('user.pagination.user') }}
                </div>
            @else
                <div class="rounded-[24px] border border-dashed border-[#F9DCC0] bg-white px-6 py-16 text-center">
                    <span class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full bg-peach text-brand-dark">
                        <i data-lucide="search-x" class="size-6"></i>
                    </span>
                    <h2 class="mb-1 text-lg font-medium">Motor tidak ditemukan</h2>
                    <p class="mb-6 text-sm text-muted">Coba kata kunci lain atau hapus filter yang sedang dipakai.</p>
                    <x-user.button :href="route('user.motor')">Lihat Semua Motor</x-user.button>
                </div>
            @endif
        </x-user.container>
    </section>
</div>

@endsection