@extends('layouts.auth_layout')

@section('title', 'Daftar | ' . config('rental.nama'))

{{-- Panel kiri --}}
@section('panel')
    @php
        $langkah = [
            'Isi data dirimu dengan lengkap dan benar.',
            'Pilih motor, tentukan tanggal sewa, lalu bayar online.',
            'Pantau status pembayaran dan masa sewamu dari akun.',
        ];
    @endphp

    <p class="mb-3 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">{{ config('rental.nama') }}</p>
    <h2 class="mb-8 text-[30px] font-normal leading-[1.2] tracking-[-.02em]">Satu akun, perjalanan lebih mudah</h2>

    <ol class="space-y-4">
        @foreach ($langkah as $i => $l)
            <li class="flex items-start gap-3 text-sm">
                <span class="mt-0.5 flex size-6 shrink-0 items-center justify-center rounded-full bg-white text-[11px] font-bold text-brand-dark">{{ $i + 1 }}</span>
                <span>{{ $l }}</span>
            </li>
        @endforeach
    </ol>
@endsection

@section('panel_catatan')
    <p>Cukup daftar saat kamu siap memesan. Melihat motor tidak perlu akun.</p>
@endsection

{{-- Form --}}
@section('content')
    @php
        // Sementara route POST belum ada, form hanya tampilan (tidak dikirim).
        // Setelah route 'register.proses' dibuat, bagian ini otomatis aktif.
        $aksi = Route::has('register.proses') ? route('register.proses') : '#';
    @endphp

    <div class="mb-7">
        <p class="mb-2 text-[11px] font-bold uppercase tracking-[.16em] text-brand-dark">Daftar</p>
        <h1 class="mb-1 text-[28px] font-normal leading-[1.2] tracking-[-.02em]">Buat akun baru</h1>
        <p class="text-sm text-muted">Lengkapi data berikut untuk mulai memesan motor.</p>
    </div>

    <form method="POST" action="{{ $aksi }}" class="space-y-5"
          @if ($aksi === '#') onsubmit="event.preventDefault(); alert('Tampilan saja: proses pendaftaran belum dibuat.');" @endif>
        @csrf

        <x-user.input label="Nama lengkap" name="nama" placeholder="Nama sesuai identitas" autocomplete="name" />
        <x-user.input label="Email" name="email" type="email" placeholder="nama@email.com" autocomplete="email" />
        <x-user.input label="Nomor WhatsApp" name="whatsapp" type="tel" placeholder="08xxxxxxxxxx" autocomplete="tel"
                      hint="Dipakai untuk menghubungi kamu terkait pesanan." />
        <x-user.input label="Alamat" name="alamat" type="textarea" placeholder="Alamat tempat tinggal" autocomplete="street-address" />

        <div class="grid gap-5 sm:grid-cols-2">
            <x-user.input label="Kata sandi" name="password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password" />
            <x-user.input label="Ulangi kata sandi" name="password_confirmation" type="password" placeholder="Ketik ulang" autocomplete="new-password" />
        </div>

        <button type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand px-6 py-3.5 text-sm font-semibold text-ink shadow-[0_6px_16px_rgba(245,130,32,.28)] transition hover:bg-brand-hover">
            Daftar <i data-lucide="arrow-right" class="size-[18px]"></i>
        </button>
    </form>

    <p class="mt-7 text-center text-sm text-muted">
        Sudah punya akun?
        <a href="{{ Route::has('login') ? route('login') : '#' }}" class="font-semibold text-brand-dark hover:text-brand">Masuk</a>
    </p>
@endsection