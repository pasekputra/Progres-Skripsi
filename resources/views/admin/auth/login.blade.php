

@extends('layouts.auth_admin_layout')

@section('title', 'Masuk Admin')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl border border-orange-100 p-8">
        <!-- Logo / Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-orange-100 text-orange-600 mb-4 shadow-inner">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Admin Putri Ayu Rent</h1>
            <p class="text-sm text-gray-500 mt-1">Silakan masuk untuk mengelola sistem rental</p>
        </div>

        <!-- Session Status / Alert jika ada error -->
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="" class="space-y-5">
            @csrf

            <!-- Input username / Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition text-sm @error('username') border-red-500 @enderror"
                    placeholder="admin@putriayurent.com">
                @error('username')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    @if (Route::has('admin.password.request'))
                        <a href="{{ route('admin.password.request') }}" class="text-xs text-orange-600 hover:underline">Lupa sandi?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition text-sm @error('password') border-red-500 @enderror"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                    <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3 px-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                Masuk ke Dashboard
            </button>
        </form>
    </div>

    <!-- Back to Front -->
    <div class="text-center mt-6">
        <a href="{{ url('/') }}" class="text-xs text-gray-500 hover:text-orange-600 transition">
            &larr; Kembali ke Beranda Putri Ayu Rent
        </a>
    </div>
@endsection