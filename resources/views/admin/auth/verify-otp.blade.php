@extends('admin.layouts.guest')

@section('title', 'Verify OTP')

@section('content')
    <div id="loginContainer"
        class="min-h-screen flex items-center justify-center bg-zinc-50 dark:bg-zinc-950 transition-all duration-500 relative overflow-hidden">

        <!-- Animated Background Gradients (Glassmorphism) -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-emerald-500/15 dark:bg-emerald-600/10 blur-[140px] animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-[10%] -right-[10%] w-[40%] h-[60%] rounded-full bg-teal-500/15 dark:bg-teal-600/10 blur-[140px] animate-pulse" style="animation-duration: 12s;"></div>
        </div>

        <div class="w-full max-w-5xl flex flex-col lg:flex-row bg-white/85 dark:bg-zinc-900/85 backdrop-blur-2xl rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.4)] border border-zinc-200/80 dark:border-zinc-800 overflow-hidden m-4 relative z-10 animate-fade-in-up">

            <!-- Left Side / Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 flex-col justify-between p-12 bg-gradient-to-br from-emerald-50/40 via-zinc-50/80 to-teal-50/20 dark:from-zinc-900 dark:via-zinc-900/90 dark:to-emerald-950/20 border-r border-zinc-200/80 dark:border-zinc-800 text-zinc-900 dark:text-white relative overflow-hidden transition-colors duration-500">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjMDAwIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] opacity-20 dark:opacity-20"></div>
                <div class="relative z-10">
                    @if (isset($settings) && $settings->logo_type === 'image' && $settings->app_logo)
                        <img src="{{ \App\Services\FileUploadService::getFileUrl($settings->app_logo) }}"
                            alt="{{ $settings->app_name }}" class="h-10 object-contain mb-8 filter drop-shadow-xs">
                    @else
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white font-black text-xl flex items-center justify-center shadow-md shadow-emerald-500/20 mb-8">
                            {{ strtoupper(substr(isset($settings) && $settings->app_name ? $settings->app_name : 'InForge', 0, 1)) }}
                        </div>
                    @endif

                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4 text-zinc-900 dark:text-white">
                        Two-Factor<br>
                        Authentication<span class="text-emerald-500">.</span>
                    </h1>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm sm:text-base max-w-sm leading-relaxed">
                        Protecting your account with an extra layer of real-time security.
                    </p>
                </div>

                <div class="relative z-10 pt-8 border-t border-zinc-200/60 dark:border-zinc-800">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Secure Identity Verification
                    </span>
                </div>
            </div>

            <!-- Right Side / Form -->
            <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    @if (isset($settings) && $settings->logo_type === 'image' && $settings->app_logo)
                        <img src="{{ \App\Services\FileUploadService::getFileUrl($settings->app_logo) }}"
                            alt="{{ $settings->app_name }}" class="h-10 mx-auto object-contain">
                    @else
                        <div class="mx-auto w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white font-black text-lg flex items-center justify-center shadow-md shadow-emerald-500/20">
                            {{ strtoupper(substr(isset($settings) && $settings->app_name ? $settings->app_name : 'InForge', 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="text-center lg:text-left mb-8">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight">Verify OTP</h2>
                    <p class="mt-1 text-xs sm:text-sm text-zinc-500 dark:text-zinc-400">Please enter the 6-digit OTP code sent to your email.</p>
                </div>

                <!-- OTP Form -->
                <form class="space-y-6" action="{{ route('admin.login.otp.post') }}" method="POST" id="otpForm">
                    @csrf

                    <!-- OTP Field using floating style -->
                    <div>
                        <div class="relative">
                            <input type="text" name="otp" id="otp" required maxlength="6" autocomplete="off" placeholder=" "
                                class="block px-4 pb-3 pt-3 w-full text-center text-3xl font-mono tracking-widest text-zinc-900 bg-transparent rounded-xl border border-zinc-200/80 appearance-none dark:text-white dark:border-zinc-700/80 dark:focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 peer transition-colors" value="{{ old('otp') }}">
                            <label for="otp"
                                class="absolute text-xs uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white/70 dark:bg-zinc-900/70 backdrop-blur px-2 peer-focus:px-2 peer-focus:text-emerald-600 peer-focus:dark:text-emerald-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-2 cursor-text rounded-md">Verification Code</label>
                        </div>
                        @error('otp')
                            <div class="mt-3">
                                <x-alert variant="danger">
                                    {{ $message }}
                                </x-alert>
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <x-button type="submit" variant="primary" :solid="true" size="xl" :fullWidth="true">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Verify OTP</span>
                        </x-button>
                    </div>
                </form>

                <form action="{{ route('admin.login.otp.resend') }}" method="POST" class="text-center mt-6" id="resendForm">
                    @csrf
                    <button type="submit" id="resendBtn" disabled class="text-xs sm:text-sm font-medium text-zinc-400 dark:text-zinc-500 transition-colors cursor-not-allowed">
                        Didn't receive the code? Resend OTP <span id="countdown"></span>
                    </button>
                    <div class="mt-4">
                        <x-button href="{{ route('admin.login') }}" variant="ghost" size="sm">
                            &larr; Back to Login
                        </x-button>
                    </div>
                </form>

                <!-- Footer Info -->
                <div class="text-center mt-8">
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        © {{ date('Y') }} {{ isset($settings) ? $settings->app_name : 'InForge' }}. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Background Theme setup
            const html = document.getElementById('adminHtml') || document.documentElement;

            const dbTheme = '{{ \App\Models\Setting::getSettings()->theme_default ?? "light" }}';
            let savedTheme = localStorage.getItem('adminTheme');
            if (!savedTheme) {
                if (dbTheme === 'system') {
                    savedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                } else {
                    savedTheme = dbTheme;
                }
            }
            if (savedTheme === 'dark') {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }

            // Auto focus on OTP input
            const otpInput = document.getElementById('otp');
            if(otpInput) {
                otpInput.focus();
            }

            // Resend OTP Countdown logic
            const resendBtn = document.getElementById('resendBtn');
            const countdownSpan = document.getElementById('countdown');
            const resendForm = document.getElementById('resendForm');

            function startCountdown(duration) {
                let timer = duration;
                resendBtn.disabled = true;
                resendBtn.classList.remove('text-blue-600', 'dark:text-blue-400', 'hover:text-blue-800', 'dark:hover:text-blue-300');
                resendBtn.classList.add('text-zinc-400', 'dark:text-zinc-500', 'cursor-not-allowed');

                const interval = setInterval(function () {
                    countdownSpan.textContent = `(${timer}s)`;
                    if (--timer < 0) {
                        clearInterval(interval);
                        countdownSpan.textContent = '';
                        resendBtn.disabled = false;
                        resendBtn.classList.add('text-blue-600', 'dark:text-blue-400', 'hover:text-blue-800', 'dark:hover:text-blue-300');
                        resendBtn.classList.remove('text-zinc-400', 'dark:text-zinc-500', 'cursor-not-allowed');
                    }
                }, 1000);
            }

            // Check session storage for existing timer
            let availableAt = sessionStorage.getItem('otpResendAvailableAt');
            const now = Math.floor(Date.now() / 1000);

            if (availableAt && parseInt(availableAt) > now) {
                startCountdown(parseInt(availableAt) - now);
            } else {
                startCountdown(30);
                sessionStorage.setItem('otpResendAvailableAt', now + 30);
            }

            // On submit, reset timer
            resendForm.addEventListener('submit', function() {
                sessionStorage.setItem('otpResendAvailableAt', Math.floor(Date.now() / 1000) + 30);
            });
        });
    </script>
@endsection
