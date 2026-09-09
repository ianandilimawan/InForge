@extends('admin.layouts.guest')

@section('title', 'Login')

@section('content')
    <div id="loginContainer"
        class="min-h-screen flex items-center justify-center bg-zinc-50 dark:bg-zinc-950 transition-all duration-500 relative overflow-hidden">

        <!-- Theme Toggle -->
        <div class="absolute top-6 right-6 z-50 animate-fade-in-up" style="animation-delay: 0.2s;">
            <x-button id="themeToggle" variant="secondary" class="p-2.5 bg-white/70 dark:bg-zinc-900/70 backdrop-blur-md hover:scale-105" title="Toggle theme">
                <x-heroicon-s-sun id="sunIcon" class="w-4 h-4" style="display: block;" />
                <x-heroicon-s-moon id="moonIcon" class="w-4 h-4" style="display: none;" />
            </x-button>
        </div>

        <!-- Animated Background Gradients (Glassmorphism) -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-emerald-500/15 dark:bg-emerald-600/10 blur-[140px] animate-pulse"
                style="animation-duration: 8s;"></div>
            <div class="absolute bottom-[10%] -right-[10%] w-[40%] h-[60%] rounded-full bg-teal-500/15 dark:bg-teal-600/10 blur-[140px] animate-pulse"
                style="animation-duration: 12s;"></div>
        </div>

        <div
            class="w-full max-w-5xl flex flex-col lg:flex-row bg-white/85 dark:bg-zinc-900/85 backdrop-blur-2xl rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.4)] border border-zinc-200/80 dark:border-zinc-800 overflow-hidden m-4 relative z-10 animate-fade-in-up">

            <!-- Left Side / Branding (Hidden on mobile) -->
            <div
                class="hidden lg:flex lg:w-1/2 flex-col justify-between p-12 bg-gradient-to-br from-emerald-50/40 via-zinc-50/80 to-teal-50/20 dark:from-zinc-900 dark:via-zinc-900/90 dark:to-emerald-950/20 border-r border-zinc-200/80 dark:border-zinc-800 text-zinc-900 dark:text-white relative overflow-hidden transition-colors duration-500">
                <div
                    class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjMDAwIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] opacity-20 dark:opacity-20">
                </div>
                <div class="relative z-10">
                    @if (isset($settings) && $settings->logo_type === 'image' && $settings->app_logo)
                        <img src="{{ \App\Services\FileUploadService::getFileUrl($settings->app_logo) }}"
                            alt="{{ $settings->app_name }}"
                            class="h-10 object-contain mb-8 filter drop-shadow-xs">
                    @else
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white font-black text-xl flex items-center justify-center shadow-md shadow-emerald-500/20 mb-8">
                            {{ strtoupper(substr(isset($settings) && $settings->app_name ? $settings->app_name : 'InForge', 0, 1)) }}
                        </div>
                    @endif

                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4 text-zinc-900 dark:text-white">
                        Welcome to<br>
                        {{ isset($settings) && $settings->logo_text ? $settings->logo_text : (isset($settings) ? $settings->app_name : 'InForge') }}<span class="text-emerald-500">.</span>
                    </h1>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm sm:text-base max-w-sm leading-relaxed">
                        Experience the powerful and seamless management dashboard tailored for your business needs.
                    </p>

                    <div class="mt-8 space-y-2.5">
                        <div class="flex items-center gap-2.5 text-xs font-semibold text-zinc-600 dark:text-zinc-300">
                            <div class="w-5 h-5 rounded-lg bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span>Granular Role & Permissions Control</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs font-semibold text-zinc-600 dark:text-zinc-300">
                            <div class="w-5 h-5 rounded-lg bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span>Real-Time Activity Audit Trail</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs font-semibold text-zinc-600 dark:text-zinc-300">
                            <div class="w-5 h-5 rounded-lg bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <span>Modern Native Blade & Livewire UI Kit</span>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 pt-8 border-t border-zinc-200/60 dark:border-zinc-800">
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Secure Administration Environment
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
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight">Sign in</h2>
                    <p class="mt-1 text-xs sm:text-sm text-zinc-500 dark:text-zinc-400">Please enter your details to access your account.</p>
                </div>

                <!-- Login Form -->
                <form class="space-y-5" action="{{ route('admin.login.post') }}" method="POST" id="loginForm">
                    @csrf

                    <!-- Single Error Message Banner -->
                    @if ($errors->any())
                        <x-alert variant="danger" :dismissible="true">
                            {{ $errors->first() }}
                        </x-alert>
                    @endif

                    <!-- Email Field -->
                    <div>
                        <x-input type="email" name="email" label="Email Address" value="{{ old('email') }}"
                            placeholder="name@example.com" :required="true" />
                    </div>

                    <!-- Password Field -->
                    <div>
                        <x-password name="password" label="Password" placeholder="••••••••" :required="true" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <x-checkbox name="remember" id="remember-me" label="Remember me" color="primary" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <x-button type="submit" variant="primary" :solid="true" size="xl" :fullWidth="true" id="submitBtn">
                            <span id="submitText">Sign in securely</span>
                            <svg id="submitSpinner" class="animate-spin ml-2 h-4 w-4 text-white hidden"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </x-button>
                    </div>
                </form>

                <!-- Footer Info -->
                <div class="text-center mt-8">
                    <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        © {{ date('Y') }} {{ isset($settings) ? $settings->app_name : 'InForge' }}. Created By
                        <a class="text-emerald-600 dark:text-emerald-400 font-semibold hover:underline" href="https://intechstudio.id">Intech Studio</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html = document.documentElement;
            // Get saved theme or default to DB setting to ensure proper rendering if head script missed it
            const dbTheme = '{{ \App\Models\Setting::getSettings()->theme_default ?? 'light' }}';
            let savedTheme = localStorage.getItem('adminTheme');
            if (!savedTheme) {
                if (dbTheme === 'system') {
                    savedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                } else {
                    savedTheme = dbTheme;
                }
            }

            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');

            function applyTheme(theme) {
                if (theme === 'dark') {
                    html.classList.add('dark');
                    if (sunIcon) sunIcon.style.display = 'none';
                    if (moonIcon) moonIcon.style.display = 'block';
                } else {
                    html.classList.remove('dark');
                    if (sunIcon) sunIcon.style.display = 'block';
                    if (moonIcon) moonIcon.style.display = 'none';
                }
            }

            applyTheme(savedTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const isDark = html.classList.contains('dark');
                    const newTheme = isDark ? 'light' : 'dark';
                    applyTheme(newTheme);
                    localStorage.setItem('adminTheme', newTheme);
                });
            }

            // Spinner on submit
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const btn = document.getElementById('submitBtn');
                    const text = document.getElementById('submitText');
                    const spinner = document.getElementById('submitSpinner');

                    if (btn && !btn.disabled) {
                        btn.disabled = true;
                        btn.classList.add('opacity-75', 'cursor-not-allowed');
                        text.textContent = 'Signing in...';
                        spinner.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
@endsection
