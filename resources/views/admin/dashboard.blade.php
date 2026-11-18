@extends('layouts.admin_layout')

@section('title', 'Dashboard')

@section('content')
    @php
        // Data contoh. Nanti diganti variabel dari DashboardController.
        $ringkasan = [
            ['label' => 'Total Motor',       'value' => 12,         'hint' => '8 tersedia'],
            ['label' => 'Sedang Disewa',     'value' => 4,          'hint' => 'hari ini'],
            ['label' => 'Transaksi Pending', 'value' => 3,          'hint' => 'perlu dicek'],
            ['label' => 'Pendapatan Bulan Ini', 'value' => 'Rp 4.250.000', 'hint' => 'Oktober 2026'],
        ];
    @endphp

    <x-admin.page-header title="Dashboard" subtitle="Ringkasan penyewaan motor." />

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($ringkasan as $r)
            <x-admin.stat-card :label="$r['label']" :value="$r['value']" :hint="$r['hint']" />
        @endforeach
    </div>

    <p class="mt-6 text-sm text-gray-500">Transaksi terbaru dan motor mendekati batas sewa dibuat di langkah 3.</p>
@endsection
