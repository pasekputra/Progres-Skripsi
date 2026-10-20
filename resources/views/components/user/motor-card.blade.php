{{--
    Kartu satu motor. Pemakaian: <x-user.motor-card :motor="$motor" />
--}}
@props(['motor'])

@php
    $placeholder = asset('images/placeholder-motor.svg');
    $tahun       = $motor->year ?? $motor->tahun_produksi;
@endphp

<article class="flex flex-col overflow-hidden rounded-[20px] border border-line bg-white shadow-card transition hover:-translate-y-[3px] hover:shadow-[0_14px_32px_rgba(194,87,12,.14)]">
    <a href="{{ route('user.motor.detail', $motor->id) }}" class="relative block h-[236px] bg-[#F3E6D8]">
        <img src="{{ $motor->gambar ? asset('storage/motor/' . $motor->gambar) : $placeholder }}"
             alt="{{ $motor->merk }} {{ $motor->nama }}" loading="lazy"
             class="size-full object-cover"
             onerror="this.onerror=null;this.src='{{ $placeholder }}'">

        @if ($motor->isTersedia())
            <span class="absolute left-3.5 top-3.5 inline-flex items-center gap-1.5 rounded-full bg-leaf-tint px-2.5 py-1 text-[11px] font-semibold text-leaf">
                <i class="size-1.5 rounded-full bg-leaf"></i>Tersedia
            </span>
        @else
            <span class="absolute left-3.5 top-3.5 inline-flex items-center gap-1.5 rounded-full bg-white px-2.5 py-1 text-[11px] font-semibold text-muted">
                <i class="size-1.5 rounded-full bg-muted"></i>Sedang Disewa
            </span>
        @endif
    </a>

    <div class="flex flex-1 flex-col px-5 pb-5 pt-[18px]">
        <div class="mb-1.5 flex items-center justify-between">
            <span class="text-[11px] font-bold uppercase tracking-[.12em] text-brand-dark">{{ $motor->merk }}</span>
            @if ($tahun)
                <span class="rounded-lg bg-peach-soft px-2.5 py-1 text-[11px] font-semibold text-brand-dark">{{ $tahun }}</span>
            @endif
        </div>
        <h3 class="mb-1 text-xl font-medium tracking-[-.01em]">
            <a href="{{ route('user.motor.detail', $motor->id) }}" class="hover:text-brand-dark">{{ $motor->nama }}</a>
        </h3>
        <p class="text-xs text-muted">{{ $motor->kategori->nama ?? '-' }}</p>

        <div class="mt-auto flex items-center justify-between border-t border-line pt-4">
            <div>
                <strong class="block text-[17px] font-bold leading-tight text-brand-dark">Rp {{ number_format((float) $motor->harga_per_hari, 0, ',', '.') }}</strong>
                <small class="text-[11px] text-muted">/ hari</small>
            </div>
            <x-user.button :href="route('user.motor.detail', $motor->id)" variant="outline" size="sm">Lihat Detail</x-user.button>
        </div>
    </div>
</article>