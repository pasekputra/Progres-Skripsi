@extends('layouts.user_layout')

@section('title', $motor->merk . ' ' . $motor->nama . ' | ' . config('rental.nama'))

@section('content')

@php
    $kontak      = config('rental.kontak');
    $placeholder = asset('images/placeholder-motor.svg');
    $tahun       = $motor->year ?? $motor->tahun_produksi;
    $harga       = (float) $motor->harga_per_hari;
    $tersedia    = $motor->isTersedia();

    // ---------- Pengaturan booking (ubah di sini bila aturan berubah) ----------
    $hitungInklusif = true;  // true  : 22–24 dihitung 3 hari (hari terakhir ikut dihitung)
                             // false : 22–24 dihitung 2 hari (per 24 jam)
    $maksHari       = 30;    // batas lama sewa lewat form ini
    $hariIni        = now('Asia/Makassar')->toDateString(); // Bali memakai WITA

    $pesanUmum = 'Halo ' . config('rental.nama') . ', saya ingin menyewa ' . $motor->merk . ' ' . $motor->nama . '.';
    $linkWa    = 'https://wa.me/' . $kontak['whatsapp'] . '?text=' . rawurlencode($pesanUmum);

    // Halaman pemesanan (dibuat nanti). Selama belum ada, tombol sewa diarahkan ke WhatsApp.
    $urlSewa  = Route::has('sewa.create') ? route('sewa.create', $motor->id) : null;
    $linkSewa = $urlSewa ? $urlSewa . '?mulai=' . $hariIni . '&selesai=' . $hariIni : $linkWa;

    $spesifikasi = [
        ['label' => 'Merk',     'nilai' => $motor->merk],
        ['label' => 'Tahun',    'nilai' => $tahun ?: '-'],
        ['label' => 'Kategori', 'nilai' => $motor->kategori->nama ?? '-'],
        ['label' => 'Status',   'nilai' => $tersedia ? 'Tersedia' : 'Sedang Disewa'],
    ];

    $inputTanggal = 'h-11 w-full rounded-xl border border-line bg-white px-3 text-sm outline-none transition focus:border-brand focus:ring-2 focus:ring-brand/30';
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
                <span class="font-medium text-ink">{{ $motor->nama }}</span>
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

                    {{-- ===================== BOOKING ===================== --}}
                    @if ($tersedia)
                        <div class="mb-5 rounded-[18px] border border-[#F9DCC0] bg-peach-soft p-5">
                            <p class="mb-4 text-[13px] font-semibold">Pilih tanggal sewa</p>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div>
                                    <label for="tglMulai" class="mb-1.5 block text-[12px] font-semibold text-muted">Tanggal mulai</label>
                                    <input id="tglMulai" type="date" value="{{ $hariIni }}" min="{{ $hariIni }}" class="{{ $inputTanggal }}">
                                </div>
                                <div>
                                    <label for="tglSelesai" class="mb-1.5 block text-[12px] font-semibold text-muted">Tanggal selesai</label>
                                    <input id="tglSelesai" type="date" value="{{ $hariIni }}" min="{{ $hariIni }}" class="{{ $inputTanggal }}">
                                </div>
                            </div>

                            <p id="pesanTanggal" role="alert" class="mt-3 hidden text-xs font-medium text-red-600"></p>

                            <dl class="mt-5 space-y-2.5 border-t border-[#F9DCC0] pt-4 text-sm" aria-live="polite">
                                <div class="flex items-center justify-between gap-4">
                                    <dt class="text-muted">Biaya sewa</dt>
                                    <dd id="rincianHari" class="font-medium">Rp {{ number_format($harga, 0, ',', '.') }} × 1 hari</dd>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <dt class="font-semibold">Total</dt>
                                    <dd id="totalHarga" class="text-xl font-bold text-brand-dark">Rp {{ number_format($harga, 0, ',', '.') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <p class="mb-5 text-xs text-muted">
                            Total di atas hanya perkiraan. Total akhir dihitung ulang saat pemesanan.
                            @if ($hitungInklusif) Hari terakhir ikut dihitung. @endif
                        </p>
                    @else
                        <div class="mb-5 flex items-start gap-3 rounded-[18px] border border-line bg-white p-5 text-sm text-muted">
                            <i data-lucide="info" class="mt-0.5 size-[18px] shrink-0 text-brand-dark"></i>
                            <p>Motor ini sedang disewa. Hubungi kami untuk menanyakan kapan tersedia kembali, atau lihat motor lainnya di bawah.</p>
                        </div>
                    @endif

                    {{-- Tombol aksi --}}
                    <div class="flex flex-wrap gap-3">
                        @if ($tersedia)
                            <x-user.button :href="$linkSewa" id="tombolSewa">
                                Sewa Sekarang <i data-lucide="arrow-right" class="size-[18px]"></i>
                            </x-user.button>
                        @else
                            <span class="inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-xl border border-line bg-white px-6 py-3.5 text-sm font-semibold text-muted">
                                Sedang Disewa
                            </span>
                        @endif
                        <x-user.button :href="$linkWa" variant="outline" id="tombolWa" target="_blank" rel="noopener">
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
    // Pengaturan dari server
    const harga          = @json($harga);
    const maksHari       = @json($maksHari);
    const hitungInklusif = @json($hitungInklusif);
    const urlSewa        = @json($urlSewa);          // null selama halaman sewa belum dibuat
    const namaMotor      = @json($motor->merk . ' ' . $motor->nama);
    const namaUsaha      = @json(config('rental.nama'));
    const nomorWa        = @json($kontak['whatsapp']);
    const pesanUmum      = @json($pesanUmum);

    const elMulai   = document.getElementById('tglMulai');
    const elSelesai = document.getElementById('tglSelesai');
    const elPesan   = document.getElementById('pesanTanggal');
    const elRincian = document.getElementById('rincianHari');
    const elTotal   = document.getElementById('totalHarga');
    const tombolSewa = document.getElementById('tombolSewa');
    const tombolWa   = document.getElementById('tombolWa');

    // Tanggal "YYYY-MM-DD" -> milidetik UTC (menghindari selisih jam / zona waktu)
    const keUtc   = (v) => { const [y, m, d] = v.split('-').map(Number); return Date.UTC(y, m - 1, d); };
    const rupiah  = (n) => 'Rp ' + n.toLocaleString('id-ID');
    const tglIndo = (v) => new Date(keUtc(v)).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', timeZone: 'UTC' });

    function atur(tombol, aktif) {
        tombol.classList.toggle('pointer-events-none', !aktif);
        tombol.classList.toggle('opacity-50', !aktif);
        tombol.setAttribute('aria-disabled', String(!aktif));
    }

    function perbarui() {
        const mulai = elMulai.value;
        const selesai = elSelesai.value;
        let hari = 0;
        let pesan = '';

        // Tanggal selesai tidak boleh sebelum tanggal mulai
        if (mulai) elSelesai.min = mulai;

        if (!mulai || !selesai) {
            pesan = 'Pilih tanggal mulai dan tanggal selesai.';
        } else {
            const selisih = (keUtc(selesai) - keUtc(mulai)) / 86400000;
            if (selisih < 0) {
                pesan = 'Tanggal selesai tidak boleh sebelum tanggal mulai.';
            } else {
                hari = hitungInklusif ? selisih + 1 : Math.max(selisih, 1);
                if (hari > maksHari) {
                    pesan = 'Maksimal ' + maksHari + ' hari. Hubungi kami untuk sewa lebih lama.';
                    hari = 0;
                }
            }
        }

        const valid = hari > 0;
        elRincian.textContent = valid ? rupiah(harga) + ' × ' + hari + ' hari' : '-';
        elTotal.textContent   = valid ? rupiah(harga * hari) : '-';
        elPesan.textContent   = pesan;
        elPesan.classList.toggle('hidden', pesan === '');

        // Tombol "Sewa Sekarang": ke halaman sewa (jika sudah ada) atau ke WhatsApp
        if (valid) {
            const teks = 'Halo ' + namaUsaha + ', saya ingin menyewa ' + namaMotor +
                         ' dari ' + tglIndo(mulai) + ' sampai ' + tglIndo(selesai) + ' (' + hari + ' hari).';
            const linkWa = 'https://wa.me/' + nomorWa + '?text=' + encodeURIComponent(teks);

            tombolSewa.href = urlSewa ? urlSewa + '?mulai=' + mulai + '&selesai=' + selesai : linkWa;
            tombolWa.href   = linkWa;
        } else {
            tombolSewa.href = '#';
            tombolWa.href   = 'https://wa.me/' + nomorWa + '?text=' + encodeURIComponent(pesanUmum);
        }
        atur(tombolSewa, valid);
    }

    elMulai.addEventListener('change', () => {
        // Jika tanggal selesai terlanjur lebih awal, ikutkan tanggal mulai
        if (elSelesai.value && elSelesai.value < elMulai.value) elSelesai.value = elMulai.value;
        perbarui();
    });
    elSelesai.addEventListener('change', perbarui);
    perbarui();
</script>
@endif
@endpush