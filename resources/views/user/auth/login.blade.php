@extends('layouts.auth_layout')

@section('title', 'Masuk | ' . config('rental.nama'))

{{-- Panel kiri --}}
@section('panel')
    @php
        $manfaat = [
            'Pesan dan bayar motor online dalam satu alur.',
            'Lihat riwayat sewa dan status pembayaranmu.',
            'Dapat pengingat sebelum masa sewa berakhir.',
        ];
    @endphp

    <p class="mb-3 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">{{ config('rental.nama') }}</p>
    <h2 class="mb-8 text-[30px] font-normal leading-[1.2] tracking-[-.02em]">Selamat datang kembali</h2>

    <ul class="space-y-4">
        @foreach ($manfaat as $m)
            <li class="flex items-start gap-3 text-sm">
                <span class="mt-0.5 flex size-6 shrink-0 items-center justify-center rounded-full bg-white text-brand-dark">
                    <i data-lucide="check" class="size-3.5"></i>
                </span>
                <span>{{ $m }}</span>
            </li>
        @endforeach
    </ul>
@endsection

@section('panel_catatan')
    <p>Melihat daftar motor tidak perlu akun.</p>
@endsection

{{-- Form --}}
@section('content')
    @php
        // Sementara route POST belum ada, form hanya tampilan (tidak dikirim).
        // Setelah route 'login.proses' dibuat, bagian ini otomatis aktif.
        $aksi = Route::has('login.proses') ? route('login.proses') : '#';
    @endphp

    <div class="mb-7">
        <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Masuk</p>
        <h1 class="mb-1 text-[28px] font-normal leading-[1.2] tracking-[-.02em]">Masuk ke akunmu</h1>
        <p class="text-sm text-muted">Masuk untuk memesan motor dan melihat riwayat sewamu.</p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl border border-leaf-tint bg-leaf-tint px-4 py-3 text-sm text-leaf">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ $aksi }}" class="space-y-5"
          @if ($aksi === '#') onsubmit="event.preventDefault(); alert('Tampilan saja: proses login belum dibuat.');" @endif>
        @csrf

        <x-user.input label="Email" name="email" type="email" placeholder="nama@email.com" autocomplete="email" />
        <x-user.input label="Kata sandi" name="password" type="password" placeholder="Masukkan kata sandi" autocomplete="current-password" />

        <label class="flex items-center gap-2.5 text-sm text-muted">
            <input type="checkbox" name="remember" class="size-4 rounded border-line accent-brand">
            Ingat saya di perangkat ini
        </label>

        <button type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand px-6 py-3.5 text-sm font-semibold text-ink shadow-[0_6px_16px_rgba(245,130,32,.28)] transition hover:bg-brand-hover">
            Masuk <i data-lucide="arrow-right" class="size-[18px]"></i>
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-muted">
        Belum punya akun?
        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="font-semibold text-brand-dark hover:text-brand">Daftar sekarang</a>
    </p>
    <p class="mt-2 text-center text-sm text-muted">
        atau <a href="{{ route('user.motor') }}" class="font-semibold text-brand-dark hover:text-brand">lihat daftar motor dulu</a>
    </p>
@endsection