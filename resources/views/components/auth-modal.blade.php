<?php
if (! function_exists('formatRupiah')) {
    function formatRupiah($amount): string
    {
        if ($amount === null || $amount === '') {
            return 'Rp 0';
        }
        $num = is_numeric($amount) ? $amount : floatval(preg_replace('/[^0-9.-]/', '', $amount));
        return 'Rp ' . number_format($num, 0, ',', '.');
    }
}
if (! function_exists('rupiah')) {
    function rupiah($amount): string
    {
        return formatRupiah($amount);
    }
}
?>

<!-- filepath: c:\laragon\www\PohonUntukEsok\resources\views\components\auth-modal.blade.php -->
<!-- Modal autentikasi responsif dengan perbaikan posisi mobile -->

<div id="auth-modal" class="hidden fixed inset-0 z-50" aria-hidden="true" role="dialog" aria-modal="true">
    <!-- Overlay -->
    <div id="auth-modal-overlay" class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity duration-300"></div>

    <!-- Desktop Mode (centered modal) -->
    <div id="auth-modal-desktop" class="hidden md:flex items-center justify-center min-h-screen p-6">
        <div id="auth-modal-panel-desktop" class="relative w-full max-w-4xl transform transition-all duration-300 ease-out opacity-0 scale-95">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden flex min-h-[550px]">
                <!-- Left Side: Brand/Info -->
                <div class="w-2/5 bg-gradient-to-b from-[#2D4F2B] to-[#1e3a1d] p-8 text-white flex flex-col">
                    <div class="mb-8">
                        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-2">Bergabung Bersama Kami</h2>
                        <p class="text-white/80 text-sm">Mulai berkontribusi untuk masa depan yang lebih baik</p>
                    </div>
                    
                    <div class="flex-1 flex items-center">
                        <div class="space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Akses Penuh</h4>
                                    <p class="text-sm text-white/70">Semua fitur tersedia</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Aman & Terpercaya</h4>
                                    <p class="text-sm text-white/70">Data Anda terlindungi</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Komunitas Aktif</h4>
                                    <p class="text-sm text-white/70">Bergabung dengan komunitas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Side: Forms -->
                <div class="w-3/5 p-8 flex flex-col">
                    <!-- Close Button -->
                    <button id="auth-modal-close-desktop" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors" aria-label="Tutup modal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    
                    <!-- Desktop Tab Navigation dengan indikator aktif -->
                    <div class="flex mb-8 space-x-1 bg-gray-100 p-1 rounded-xl">
                        <button id="tab-login-desktop" class="tab-button flex-1 py-3 text-center font-medium rounded-lg bg-[#2D4F2B] text-white shadow-sm transition-all duration-200">
                            Masuk
                        </button>
                        <button id="tab-register-desktop" class="tab-button flex-1 py-3 text-center font-medium text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200">
                            Daftar
                        </button>
                    </div>
                    
                    <div class="flex-1">
                        <!-- Google Button -->
                        <div class="mb-6">
                            <a id="google-login-btn-desktop"
                               href="{{ \Illuminate\Support\Facades\Route::has('social.redirect') ? route('social.redirect', 'google') : url('/auth/google/redirect') }}"
                               class="w-full inline-flex items-center justify-center gap-3 px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-800 font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                <span>Lanjutkan dengan Google</span>
                            </a>
                        </div>
                        
                        <!-- Divider -->
                        <div class="relative mb-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500">atau dengan email</span>
                            </div>
                        </div>
                        
                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                <ul class="text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-start">
                                            <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <!-- Forms Container -->
                        <div id="forms-container-desktop" class="min-h-[380px]">
                            <!-- Login Form -->
                            <form id="form-login-desktop" method="POST" action="{{ route('login') }}" class="space-y-5">
                                @csrf
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input name="email" type="email" value="{{ old('email') }}" required
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                           placeholder="nama@email.com">
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Password</label>
                                        @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-sm text-[#2D4F2B] hover:text-[#245027] font-medium">Lupa password?</a>
                                        @endif
                                    </div>
                                    <div class="relative">
                                        <input name="password" type="password" required 
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                               placeholder="••••••••">
                                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                                            <svg class="h-5 w-5 text-gray-400 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <input type="checkbox" name="remember" id="remember-desktop" class="h-4 w-4 text-[#2D4F2B] border-gray-300 rounded">
                                    <label for="remember-desktop" class="ml-2 text-sm text-gray-700">Ingat saya di perangkat ini</label>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full py-3.5 px-4 bg-[#2D4F2B] text-white font-semibold rounded-xl hover:bg-[#245027] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2D4F2B] transition-all duration-200 shadow-sm hover:shadow">
                                    Masuk ke Akun
                                </button>
                                
                                <div class="text-center pt-2">
                                    <p class="text-sm text-gray-600">
                                        Belum punya akun? 
                                        <button type="button" id="switch-to-register-desktop" class="text-[#2D4F2B] hover:text-[#245027] font-medium">
                                            Daftar sekarang
                                        </button>
                                    </p>
                                </div>
                            </form>
                            
                            <!-- Register Form -->
                            <form id="form-register-desktop" method="POST" action="{{ route('register') }}" class="space-y-5 hidden" novalidate>
                                @csrf
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                        <input name="name" type="text" value="{{ old('name') }}" required 
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                               placeholder="Nama Anda">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <input name="email" type="email" value="{{ old('email') }}" required 
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                               placeholder="nama@email.com">
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                        <div class="relative">
                                            <input name="password" type="password" required 
                                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                                   placeholder="••••••••">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                        <div class="relative">
                                            <input name="password_confirmation" type="password" required 
                                                   class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                                   placeholder="••••••••">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <input type="checkbox" name="terms" id="terms-desktop" required class="h-4 w-4 mt-1 text-[#2D4F2B] border-gray-300 rounded">
                                    <label for="terms-desktop" class="ml-2 text-sm text-gray-700">
                                        Saya menyetujui 
                                        <a href="#" class="text-[#2D4F2B] hover:text-[#245027] font-medium">Syarat & Ketentuan</a> 
                                        dan 
                                        <a href="#" class="text-[#2D4F2B] hover:text-[#245027] font-medium">Kebijakan Privasi</a>
                                    </label>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full py-3.5 px-4 bg-[#2D4F2B] text-white font-semibold rounded-xl hover:bg-[#245027] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2D4F2B] transition-all duration-200 shadow-sm hover:shadow">
                                    Buat Akun Baru
                                </button>
                                
                                <div class="text-center pt-2">
                                    <p class="text-sm text-gray-600">
                                        Sudah punya akun? 
                                        <button type="button" id="switch-to-login-desktop" class="text-[#2D4F2B] hover:text-[#245027] font-medium">
                                            Masuk di sini
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Mode (centered modal untuk mobile) -->
    <div id="auth-modal-mobile" class="md:hidden flex items-center justify-center min-h-screen p-4">
        <div id="auth-modal-panel-mobile" class="relative w-full max-w-md transform transition-all duration-300 ease-out opacity-0 scale-95">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">
                <!-- Mobile Header dengan indikator tab -->
                <div class="sticky top-0 z-10 bg-gradient-to-r from-[#2D4F2B] to-[#1e3a1d] px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div class="text-white">
                                <h2 id="mobile-modal-title" class="text-lg font-bold">Masuk</h2>
                                <p class="text-xs opacity-90">Akses akun Anda</p>
                            </div>
                        </div>
                        <button id="auth-modal-close-mobile" class="text-white/90 hover:text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-white/10" aria-label="Tutup modal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Mobile Tab Navigation dengan indikator aktif -->
                    <div class="flex space-x-1 bg-white/20 p-1 rounded-lg">
                        <button id="tab-login-mobile" class="tab-button flex-1 py-2.5 text-center font-medium text-sm rounded-md bg-white text-[#2D4F2B] transition-all duration-200">
                            Masuk
                        </button>
                        <button id="tab-register-mobile" class="tab-button flex-1 py-2.5 text-center font-medium text-sm text-white rounded-md hover:bg-white/10 transition-all duration-200">
                            Daftar
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Content -->
                <div class="px-6 py-6">
                    <!-- Google Button Mobile -->
                    <div class="mb-6">
                        <a id="google-login-btn-mobile"
                           href="{{ \Illuminate\Support\Facades\Route::has('social.redirect') ? route('social.redirect', 'google') : url('/auth/google/redirect') }}"
                           class="w-full inline-flex items-center justify-center gap-3 px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-800 font-medium hover:bg-gray-50 transition-all duration-200">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            <span>Lanjutkan dengan Google</span>
                        </a>
                    </div>
                    
                    <!-- Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">atau dengan email</span>
                        </div>
                    </div>
                    
                    <!-- Error Messages Mobile -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <ul class="text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Forms Container Mobile -->
                    <div id="forms-container-mobile">
                        <!-- Login Form Mobile -->
                        <form id="form-login-mobile" method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input name="email" type="email" value="{{ old('email') }}" required
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                       placeholder="nama@email.com">
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-sm font-medium text-gray-700">Password</label>
                                    @if (\Illuminate\Support\Facades\Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-sm text-[#2D4F2B] hover:text-[#245027] font-medium">Lupa password?</a>
                                    @endif
                                </div>
                                <div class="relative">
                                    <input name="password" type="password" required 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                           placeholder="••••••••">
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password-mobile">
                                        <svg class="h-5 w-5 text-gray-400 eye-icon-mobile" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember-mobile" class="h-4 w-4 text-[#2D4F2B] border-gray-300 rounded">
                                <label for="remember-mobile" class="ml-2 text-sm text-gray-700">Ingat saya</label>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full py-3.5 px-4 bg-[#2D4F2B] text-white font-semibold rounded-xl hover:bg-[#245027] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2D4F2B] transition-all duration-200">
                                Masuk
                            </button>
                            
                            <div class="text-center pt-2">
                                <p class="text-sm text-gray-600">
                                    Belum punya akun? 
                                    <button type="button" id="switch-to-register-mobile" class="text-[#2D4F2B] hover:text-[#245027] font-medium">
                                        Daftar
                                    </button>
                                </p>
                            </div>
                        </form>
                        
                        <!-- Register Form Mobile -->
                        <form id="form-register-mobile" method="POST" action="{{ route('register') }}" class="space-y-4 hidden" novalidate>
                            @csrf
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input name="name" type="text" value="{{ old('name') }}" required 
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                       placeholder="Nama Anda">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input name="email" type="email" value="{{ old('email') }}" required 
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                       placeholder="nama@email.com">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="relative">
                                    <input name="password" type="password" required 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                           placeholder="••••••••">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                <div class="relative">
                                    <input name="password_confirmation" type="password" required 
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D4F2B] focus:border-[#2D4F2B] transition-all duration-200 placeholder-gray-400"
                                           placeholder="••••••••">
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" id="terms-mobile" required class="h-4 w-4 mt-1 text-[#2D4F2B] border-gray-300 rounded">
                                <label for="terms-mobile" class="ml-2 text-sm text-gray-700">
                                    Saya menyetujui 
                                    <a href="#" class="text-[#2D4F2B] hover:text-[#245027] font-medium">Syarat & Ketentuan</a>
                                </label>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full py-3.5 px-4 bg-[#2D4F2B] text-white font-semibold rounded-xl hover:bg-[#245027] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2D4F2B] transition-all duration-200">
                                Daftar
                            </button>
                            
                            <div class="text-center pt-2">
                                <p class="text-sm text-gray-600">
                                    Sudah punya akun? 
                                    <button type="button" id="switch-to-login-mobile" class="text-[#2D4F2B] hover:text-[#245027] font-medium">
                                        Masuk
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    const modal = document.getElementById('auth-modal');
    const overlay = document.getElementById('auth-modal-overlay');
    
    // Desktop elements
    const desktopContainer = document.getElementById('auth-modal-desktop');
    const desktopPanel = document.getElementById('auth-modal-panel-desktop');
    const closeBtnDesktop = document.getElementById('auth-modal-close-desktop');
    const tabLoginDesktop = document.getElementById('tab-login-desktop');
    const tabRegisterDesktop = document.getElementById('tab-register-desktop');
    const formLoginDesktop = document.getElementById('form-login-desktop');
    const formRegisterDesktop = document.getElementById('form-register-desktop');
    const switchToRegisterDesktop = document.getElementById('switch-to-register-desktop');
    const switchToLoginDesktop = document.getElementById('switch-to-login-desktop');
    
    // Mobile elements
    const mobileContainer = document.getElementById('auth-modal-mobile');
    const mobilePanel = document.getElementById('auth-modal-panel-mobile');
    const closeBtnMobile = document.getElementById('auth-modal-close-mobile');
    const tabLoginMobile = document.getElementById('tab-login-mobile');
    const tabRegisterMobile = document.getElementById('tab-register-mobile');
    const formLoginMobile = document.getElementById('form-login-mobile');
    const formRegisterMobile = document.getElementById('form-register-mobile');
    const switchToRegisterMobile = document.getElementById('switch-to-register-mobile');
    const switchToLoginMobile = document.getElementById('switch-to-login-mobile');
    const mobileModalTitle = document.getElementById('mobile-modal-title');
    
    // Fungsi untuk memastikan modal berada di body
    function ensureModalInBody() {
        try {
            if (modal && modal.parentNode !== document.body) {
                document.body.appendChild(modal);
            }
        } catch (e) {
            console.warn('Could not move modal to body:', e);
        }
    }
    
    // Fungsi untuk menampilkan tab tertentu (desktop)
    function showTabDesktop(isLogin) {
        if (isLogin) {
            formLoginDesktop.classList.remove('hidden');
            formRegisterDesktop.classList.add('hidden');
            tabLoginDesktop.classList.add('bg-[#2D4F2B]', 'text-white');
            tabLoginDesktop.classList.remove('text-gray-700', 'hover:bg-gray-200');
            tabRegisterDesktop.classList.remove('bg-[#2D4F2B]', 'text-white');
            tabRegisterDesktop.classList.add('text-gray-700', 'hover:bg-gray-200');
        } else {
            formLoginDesktop.classList.add('hidden');
            formRegisterDesktop.classList.remove('hidden');
            tabRegisterDesktop.classList.add('bg-[#2D4F2B]', 'text-white');
            tabRegisterDesktop.classList.remove('text-gray-700', 'hover:bg-gray-200');
            tabLoginDesktop.classList.remove('bg-[#2D4F2B]', 'text-white');
            tabLoginDesktop.classList.add('text-gray-700', 'hover:bg-gray-200');
        }
    }
    
    // Fungsi untuk menampilkan tab tertentu (mobile)
    function showTabMobile(isLogin) {
        if (isLogin) {
            formLoginMobile.classList.remove('hidden');
            formRegisterMobile.classList.add('hidden');
            tabLoginMobile.classList.add('bg-white', 'text-[#2D4F2B]');
            tabLoginMobile.classList.remove('text-white', 'hover:bg-white/10');
            tabRegisterMobile.classList.remove('bg-white', 'text-[#2D4F2B]');
            tabRegisterMobile.classList.add('text-white', 'hover:bg-white/10');
            mobileModalTitle.textContent = 'Masuk';
        } else {
            formLoginMobile.classList.add('hidden');
            formRegisterMobile.classList.remove('hidden');
            tabRegisterMobile.classList.add('bg-white', 'text-[#2D4F2B]');
            tabRegisterMobile.classList.remove('text-white', 'hover:bg-white/10');
            tabLoginMobile.classList.remove('bg-white', 'text-[#2D4F2B]');
            tabLoginMobile.classList.add('text-white', 'hover:bg-white/10');
            mobileModalTitle.textContent = 'Daftar';
        }
    }
    
    // Fungsi untuk menampilkan modal dengan animasi
    window.showAuthModal = function() {
        ensureModalInBody();
        
        if (!modal) return;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Trigger reflow
        void modal.offsetWidth;
        
        // Animasikan overlay
        if (overlay) {
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.style.opacity = '1';
            }, 10);
        }
        
        // Tentukan mode berdasarkan ukuran layar
        const isMobile = window.innerWidth < 768;
        
        if (isMobile) {
            // Mobile mode: animasi scale
            if (mobilePanel) {
                mobilePanel.style.opacity = '1';
                mobilePanel.style.transform = 'scale(1)';
            }
        } else {
            // Desktop mode: animasi scale
            if (desktopPanel) {
                desktopPanel.style.opacity = '1';
                desktopPanel.style.transform = 'scale(1)';
            }
        }
        
        // Tampilkan tab login
        showTabDesktop(true);
        showTabMobile(true);
        
        // Fokus ke input yang sesuai
        setTimeout(() => {
            if (isMobile) {
                const emailInput = formLoginMobile.querySelector('input[type="email"]');
                if (emailInput) emailInput.focus();
            } else {
                const emailInput = formLoginDesktop.querySelector('input[type="email"]');
                if (emailInput) emailInput.focus();
            }
        }, 300);
    };
    
    // Fungsi untuk menyembunyikan modal dengan animasi
    window.hideAuthModal = function() {
        if (!modal) return;
        
        const isMobile = window.innerWidth < 768;
        
        if (isMobile) {
            // Mobile mode: animasi scale out
            if (mobilePanel) {
                mobilePanel.style.opacity = '0';
                mobilePanel.style.transform = 'scale(0.95)';
            }
        } else {
            // Desktop mode: animasi scale out
            if (desktopPanel) {
                desktopPanel.style.opacity = '0';
                desktopPanel.style.transform = 'scale(0.95)';
            }
        }
        
        // Animasikan overlay
        if (overlay) {
            overlay.style.opacity = '0';
        }
        
        // Tunggu animasi selesai sebelum disembunyikan
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    };
    
    // Fungsi untuk membuka modal ke tab register
    window.openRegisterModal = function() {
        ensureModalInBody();
        
        if (!modal) return;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Trigger reflow
        void modal.offsetWidth;
        
        // Animasikan overlay
        if (overlay) {
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.style.opacity = '1';
            }, 10);
        }
        
        const isMobile = window.innerWidth < 768;
        
        if (isMobile) {
            if (mobilePanel) {
                mobilePanel.style.opacity = '1';
                mobilePanel.style.transform = 'scale(1)';
            }
        } else {
            if (desktopPanel) {
                desktopPanel.style.opacity = '1';
                desktopPanel.style.transform = 'scale(1)';
            }
        }
        
        // Tampilkan tab register
        showTabDesktop(false);
        showTabMobile(false);
        
        // Fokus ke input yang sesuai
        setTimeout(() => {
            if (isMobile) {
                const nameInput = formRegisterMobile.querySelector('input[type="text"]');
                if (nameInput) nameInput.focus();
            } else {
                const nameInput = formRegisterDesktop.querySelector('input[type="text"]');
                if (nameInput) nameInput.focus();
            }
        }, 300);
    };
    
    // Backwards-compatible aliases
    window.openAuthModal = window.openAuthModal || function() { window.showAuthModal(); };
    window.closeAuthModal = window.closeAuthModal || function() { window.hideAuthModal(); };
    
    // Event listeners untuk toggle password visibility
    function initPasswordToggles() {
        // Desktop
        const toggleButtonsDesktop = document.querySelectorAll('.toggle-password');
        toggleButtonsDesktop.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const input = this.closest('.relative').querySelector('input[type="password"], input[type="text"]');
                const icon = this.querySelector('.eye-icon');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                }
            });
        });
        
        // Mobile
        const toggleButtonsMobile = document.querySelectorAll('.toggle-password-mobile');
        toggleButtonsMobile.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const input = this.closest('.relative').querySelector('input[type="password"], input[type="text"]');
                const icon = this.querySelector('.eye-icon-mobile');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                }
            });
        });
    }
    
    // Setup form submission loading states
    function initFormSubmissions() {
        // Desktop forms
        [formLoginDesktop, formRegisterDesktop].forEach(form => {
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
                        submitBtn.disabled = true;
                        
                        setTimeout(function() {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 5000);
                    }
                });
            }
        });
        
        // Mobile forms
        [formLoginMobile, formRegisterMobile].forEach(form => {
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
                        submitBtn.disabled = true;
                        
                        setTimeout(function() {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 5000);
                    }
                });
            }
        });
    }
    
    // Inisialisasi saat DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        ensureModalInBody();
        
        // Setup animasi
        if (overlay) {
            overlay.style.transition = 'opacity 300ms ease-out';
        }
        
        if (desktopPanel) {
            desktopPanel.style.transition = 'opacity 300ms ease-out, transform 300ms ease-out';
        }
        
        if (mobilePanel) {
            mobilePanel.style.transition = 'opacity 300ms ease-out, transform 300ms ease-out';
        }
        
        // Setup event listeners
        if (closeBtnDesktop) closeBtnDesktop.addEventListener('click', window.hideAuthModal);
        if (closeBtnMobile) closeBtnMobile.addEventListener('click', window.hideAuthModal);
        
        if (overlay) overlay.addEventListener('click', function(e) { 
            if (e.target === overlay) window.hideAuthModal(); 
        });
        
        // Desktop tab events
        if (tabLoginDesktop) tabLoginDesktop.addEventListener('click', () => showTabDesktop(true));
        if (tabRegisterDesktop) tabRegisterDesktop.addEventListener('click', () => showTabDesktop(false));
        if (switchToRegisterDesktop) switchToRegisterDesktop.addEventListener('click', () => showTabDesktop(false));
        if (switchToLoginDesktop) switchToLoginDesktop.addEventListener('click', () => showTabDesktop(true));
        
        // Mobile tab events
        if (tabLoginMobile) tabLoginMobile.addEventListener('click', () => showTabMobile(true));
        if (tabRegisterMobile) tabRegisterMobile.addEventListener('click', () => showTabMobile(false));
        if (switchToRegisterMobile) switchToRegisterMobile.addEventListener('click', () => showTabMobile(false));
        if (switchToLoginMobile) switchToLoginMobile.addEventListener('click', () => showTabMobile(true));
        
        // Setup password toggles
        initPasswordToggles();
        
        // Setup form submissions
        initFormSubmissions();
    });
    
    // Keyboard escape untuk menutup modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
            window.hideAuthModal();
        }
    });
    
    // Handle resize untuk mereset animasi jika beralih mode
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            if (modal && !modal.classList.contains('hidden')) {
                // Reset animasi jika modal sedang terbuka
                const isMobile = window.innerWidth < 768;
                
                if (isMobile) {
                    if (mobilePanel) {
                        mobilePanel.style.opacity = '1';
                        mobilePanel.style.transform = 'scale(1)';
                    }
                } else {
                    if (desktopPanel) {
                        desktopPanel.style.opacity = '1';
                        desktopPanel.style.transform = 'scale(1)';
                    }
                }
            }
        }, 250);
    });
    
    // Expose fungsi untuk kebutuhan global
    if (typeof window.authModal === 'undefined') {
        window.authModal = {
            show: window.showAuthModal,
            hide: window.hideAuthModal,
            open: window.openAuthModal,
            openRegister: window.openRegisterModal,
            close: window.closeAuthModal
        };
    }
})();
</script>