    @extends('layouts.auth_admin_layout')

    @section('title', 'Daftar Admin')

    @section('content')
        <div class="bg-white rounded-2xl shadow-xl border border-orange-100 p-8">
            <!-- Brand Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-orange-100 text-orange-600 mb-4 shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Pendaftaran Admin Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Buat akun untuk mengelola sistem rental</p>
            </div>

            <form method="POST" action="" class="space-y-4">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition text-sm @error('name') border-red-500 @enderror"
                        placeholder="Masukkan username">
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            
        

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition text-sm @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition text-sm"
                        placeholder="••••••••">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full mt-2 py-3 px-4 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    Daftar Akun Admin
                </button>
            </form>
        </div>

        <!-- Back to Login -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('admin.login') ?? '#' }}" class="text-orange-600 font-medium hover:underline">Masuk di sini</a>
            </p>
        </div>
    @endsection