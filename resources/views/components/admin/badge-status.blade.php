@props(['status'])

@php
    $s = strtolower($status);
    $warna = match ($s) {
        'success', 'selesai', 'dikembalikan', 'tersedia' => 'bg-green-100 text-green-700',
        'pending', 'menunggu'                            => 'bg-yellow-100 text-yellow-700',
        'disewa', 'berjalan'                             => 'bg-orange-100 text-orange-700',
        'gagal', 'batal', 'dibatalkan'                   => 'bg-red-100 text-red-700',
        default                                          => 'bg-gray-100 text-gray-600',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold capitalize $warna"]) }}>
    {{ $status }}
</span>
