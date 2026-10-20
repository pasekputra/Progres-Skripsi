@extends('layouts.user_layout')

@section('title', 'Kontak | ' . config('rental.nama'))

@section('content')

@php
    $kontak = $data['kontak'];
    $sosmed = $data['sosmed'];

    // Status buka/tutup. Bali memakai WITA (Asia/Makassar).
    $jamSekarang = now('Asia/Makassar')->hour;
    $sedangBuka  = $jamSekarang >= $kontak['jam_buka'] && $jamSekarang < $kontak['jam_tutup'];

    $info = [
        ['icon' => 'map-pin', 'label' => 'Alamat',          'isi' => $kontak['alamat'],          'href' => $kontak['maps'],                  'luar' => true],
        ['icon' => 'phone',   'label' => 'Telepon',         'isi' => $kontak['telepon'],         'href' => 'tel:' . $kontak['telepon'],      'luar' => false],
        ['icon' => 'mail',    'label' => 'Email',           'isi' => $kontak['email'],           'href' => 'mailto:' . $kontak['email'],     'luar' => false],
        ['icon' => 'clock',   'label' => 'Jam Operasional', 'isi' => $kontak['jam_operasional'], 'href' => null,                             'luar' => false],
    ];

    $linkWa = 'https://wa.me/' . $kontak['whatsapp'];
    $inputKelas = 'w-full rounded-xl border border-line bg-white px-4 py-3 text-sm outline-none transition placeholder:text-muted/70 focus:border-brand focus:ring-2 focus:ring-brand/30';
@endphp

<div class="relative overflow-hidden bg-cream">

    {{-- Hiasan lingkaran --}}
    <span class="pointer-events-none absolute -top-[70px] left-[8%] z-0 size-[130px] rounded-full border-[25px] border-peach"></span>
    <span class="pointer-events-none absolute right-[3%] top-[205px] z-0 hidden size-[130px] rounded-full border-[25px] border-peach lg:block"></span>

    {{-- ===================== HEADER ===================== --}}
    <section class="relative z-[1] border-b border-line bg-peach-soft px-6 py-14 text-center sm:py-[72px]">
        <p class="mb-3 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Hubungi Kami</p>
        <h1 class="mb-3 text-[clamp(30px,4vw,44px)] font-normal leading-[1.2] tracking-[-.02em]">
            Ada yang bisa kami bantu?
        </h1>
        <p class="mx-auto max-w-[560px] text-sm text-muted">
            Tanyakan ketersediaan motor, harga, atau apa pun soal perjalananmu. Kami siap membantu.
        </p>
    </section>

    {{-- ===================== INFO + PETA ===================== --}}
    <section class="relative z-[1] py-16 sm:py-24">
        <x-user.container class="grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:gap-14">

            {{-- Kolom kiri: info kontak --}}
            <div>
                <div class="mb-5 inline-flex items-center gap-2 rounded-full border px-3.5 py-1.5 text-xs font-semibold {{ $sedangBuka ? 'border-leaf-tint bg-leaf-tint text-leaf' : 'border-line bg-white text-muted' }}">
                    <i class="size-1.5 rounded-full {{ $sedangBuka ? 'bg-leaf' : 'bg-muted' }}"></i>
                    {{ $sedangBuka ? 'Buka sekarang' : 'Sedang tutup' }}
                </div>

                <div class="space-y-3">
                    @foreach ($info as $i)
                        <div class="flex items-start gap-4 rounded-2xl border border-line bg-white p-4 shadow-card">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-peach text-brand-dark">
                                <i data-lucide="{{ $i['icon'] }}" class="size-5"></i>
                            </span>
                            <div class="min-w-0">
                                <small class="block text-[11px] font-bold uppercase tracking-[.12em] text-brand-dark">{{ $i['label'] }}</small>
                                @if ($i['href'])
                                    <a href="{{ $i['href'] }}" @if ($i['luar']) target="_blank" rel="noopener" @endif
                                       class="break-words text-sm text-ink hover:text-brand-dark">{{ $i['isi'] }}</a>
                                @else
                                    <span class="text-sm text-ink">{{ $i['isi'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <x-user.button :href="$linkWa" target="_blank" rel="noopener">
                        <i data-lucide="message-circle" class="size-[18px]"></i> Chat via WhatsApp
                    </x-user.button>
                    <x-user.button :href="$kontak['maps']" variant="outline" target="_blank" rel="noopener">
                        <i data-lucide="map-pin" class="size-[18px]"></i> Buka di Google Maps
                    </x-user.button>
                </div>

                {{-- Sosial media --}}
                <div class="mt-8">
                    <p class="mb-3 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Ikuti kami</p>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach (['instagram' => 'Instagram', 'facebook' => 'Facebook', 'twitter' => 'Twitter', 'tiktok' => 'TikTok'] as $kunci => $nama)
                            @if (! empty($sosmed[$kunci]))
                                <a href="{{ $sosmed[$kunci] }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-1.5 rounded-full border border-line bg-white px-4 py-2 text-[13px] font-medium transition hover:border-brand hover:text-brand-dark">
                                    {{ $nama }} <i data-lucide="arrow-up-right" class="size-3.5"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: peta --}}
            <div class="overflow-hidden rounded-[24px] border-8 border-white bg-peach shadow-[0_24px_48px_rgba(194,87,12,.14)]">
                {{-- Peta berdasarkan alamat. Jika titiknya kurang pas, ganti src dengan
                     "Bagikan > Sematkan peta" dari Google Maps. --}}
                <iframe title="Lokasi {{ config('rental.nama') }}"
                        src="https://www.google.com/maps?q={{ urlencode($kontak['alamat']) }}&output=embed"
                        class="h-[320px] w-full border-0 sm:h-[460px] lg:h-full lg:min-h-[460px]"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
        </x-user.container>
    </section>

    {{-- ===================== PESAN LEWAT WHATSAPP ===================== --}}
    <section class="relative z-[1] bg-peach-soft py-16 sm:py-20">
        <x-user.container class="max-w-[760px]">
            <div class="mb-8 text-center">
                <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Tulis pesan</p>
                <h2 class="mb-2 text-[clamp(26px,3.2vw,34px)] font-normal leading-[1.2] tracking-[-.02em]">Kirim pesan lewat WhatsApp</h2>
                <p class="text-[15px] text-muted">Isi nama dan pesanmu, lalu kami arahkan ke WhatsApp dengan pesan yang sudah siap.</p>
            </div>

            <form id="formWa" class="space-y-4 rounded-[24px] border border-[#F9DCC0] bg-white p-6 shadow-card sm:p-8">
                <div>
                    <label for="waNama" class="mb-1.5 block text-[13px] font-semibold">Nama</label>
                    <input id="waNama" type="text" required maxlength="60" placeholder="Nama lengkapmu" class="{{ $inputKelas }}">
                </div>
                <div>
                    <label for="waPesan" class="mb-1.5 block text-[13px] font-semibold">Pesan</label>
                    <textarea id="waPesan" rows="4" required maxlength="500"
                              placeholder="Contoh: Apakah Honda Scoopy tersedia tanggal 20–23 Oktober?"
                              class="{{ $inputKelas }} resize-y"></textarea>
                </div>
                <button type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand px-6 py-3.5 text-sm font-semibold text-ink shadow-[0_6px_16px_rgba(245,130,32,.28)] transition hover:bg-brand-hover">
                    <i data-lucide="send" class="size-[18px]"></i> Kirim ke WhatsApp
                </button>
            </form>
        </x-user.container>
    </section>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('formWa')?.addEventListener('submit', (e) => {
        e.preventDefault();
        const nama  = document.getElementById('waNama').value.trim();
        const pesan = document.getElementById('waPesan').value.trim();
        if (!nama || !pesan) return;

        const teks = `Halo ${@json(config('rental.nama'))}, saya ${nama}.\n\n${pesan}`;
        window.open('https://wa.me/{{ $kontak['whatsapp'] }}?text=' + encodeURIComponent(teks), '_blank', 'noopener');
    });
</script>
@endpush