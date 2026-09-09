<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="admin-panel overflow-hidden" id="adminHtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($settings) ? $settings->app_name : config('app.name', 'Laravel') }} - Admin</title>

    @if (isset($settings) && $settings->favicon)
        <link rel="icon" type="image/x-icon"
            href="{{ \App\Services\FileUploadService::getFileUrl($settings->favicon) }}">
        <link rel="shortcut icon" type="image/x-icon"
            href="{{ \App\Services\FileUploadService::getFileUrl($settings->favicon) }}">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />

    <!-- Global libraries now bundled via Vite (app.js) -->

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <script>
        // Initialize theme and sidebar state before body loads to prevent flash
        (function() {
            const dbTheme = '{{ $settings->theme_default ?? "light" }}';
            let savedTheme = localStorage.getItem('adminTheme');
            
            if (!savedTheme) {
                if (dbTheme === 'system') {
                    savedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                } else {
                    savedTheme = dbTheme;
                }
            }

            const html = document.documentElement;

            // Apply theme immediately before page renders
            if (savedTheme === 'dark') {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }

            // Apply sidebar state
            const dbSidebarSetting = '{{ $settings->sidebar_style ?? "full" }}';
            const dbSidebar = dbSidebarSetting === 'collapsed' ? 'closed' : 'open';
            
            let savedSidebarState = localStorage.getItem('desktopSidebarState');
            if (!savedSidebarState) {
                savedSidebarState = dbSidebar;
            }
            
            if (savedSidebarState === 'closed') {
                html.classList.add('sidebar-closed');
            }
        })();
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        html, body {
            height: 100%;
            min-height: 100%;
            min-height: 100vh;
            min-height: 100dvh;
        }

        @media (min-width: 1024px) {
            html.admin-panel, html.admin-panel body {
                height: 100vh;
                max-height: 100vh;
                overflow: hidden;
            }
        }

        /* Desktop sidebar collapsed state */
        @media (min-width: 1024px) {
            html.sidebar-closed #sidebar {
                transform: translateX(calc(-100% - 2rem)) !important;
            }

            html.sidebar-closed #sidebarSpacer {
                width: 0 !important;
                margin-right: -0.875rem !important;
            }
        }
    </style>
</head>

<body class="bg-zinc-100/80 dark:bg-[#090d12] font-sans text-sm antialiased text-zinc-900 dark:text-zinc-100 min-h-screen lg:h-screen lg:max-h-screen overflow-x-hidden lg:overflow-hidden flex flex-col" id="body">
    <div class="flex flex-1 w-full min-h-screen lg:min-h-0 lg:h-screen lg:max-h-screen lg:overflow-hidden lg:p-3.5 lg:gap-3.5">
        <!-- Left Floating Sidebar Card & Desktop Spacer -->
        @include('admin.layouts.partials.sidebar')

        <!-- Right Floating Main Workspace Card (Harmonized with Sidebar Card) -->
        <div id="mainWorkspaceCard"
            class="flex-1 flex flex-col min-w-0 w-full min-h-screen lg:min-h-[calc(100vh-1.75rem)] lg:h-[calc(100vh-1.75rem)] lg:max-h-[calc(100vh-1.75rem)] bg-white dark:bg-zinc-900 lg:rounded-2xl lg:border lg:border-zinc-200/80 lg:dark:border-zinc-800 lg:shadow-xs overflow-hidden transition-all duration-300">
            <!-- Top Navbar inside Workspace Card -->
            @include('admin.layouts.partials.navbar')

            <!-- Scrollable Page Content -->
            <main class="flex-1 overflow-y-auto min-h-0 p-3.5 sm:p-6 custom-scrollbar animate-fade-in-up pb-28 lg:pb-6">
                @yield('content')
            </main>

            <!-- Footer inside Workspace Card -->
            @include('admin.layouts.partials.footer')
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script src="{{ asset('js/powergrid.js') }}"></script>
    @livewireScripts

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-zinc-950/50 backdrop-blur-sm hidden lg:hidden"></div>

    <script>
        // Toast notification function
        function showToast(message, type = 'info', duration = 5000, solid = false) {
            if (typeof duration === 'object' && duration !== null) {
                solid = duration.solid || duration.style === 'solid' || false;
                duration = duration.duration !== undefined ? duration.duration : 5000;
            } else if (typeof duration === 'boolean') {
                solid = duration;
                duration = 5000;
            }

            const container = document.getElementById('toast-container');
            if (!container) return;

            const isSolid = !!solid;
            const toastId = 'toast-' + Date.now() + '-' + Math.floor(Math.random() * 1000);

            const iconColor = isSolid ? 'text-white' : ({
                info: 'text-blue-600 dark:text-blue-400',
                success: 'text-emerald-600 dark:text-emerald-400',
                error: 'text-rose-600 dark:text-rose-400',
                warning: 'text-amber-500 dark:text-amber-400',
                dark: 'text-zinc-700 dark:text-zinc-300'
            }[type] || 'text-blue-600 dark:text-blue-400');

            const icons = {
                info: `<svg class="w-5 h-5 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                success: `<svg class="w-5 h-5 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                error: `<svg class="w-5 h-5 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`,
                warning: `<svg class="w-5 h-5 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`,
                dark: `<svg class="w-5 h-5 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`
            };

            const softColors = {
                info: 'bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800 text-blue-900 dark:text-blue-200',
                success: 'bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200',
                error: 'bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-900 dark:text-rose-200',
                warning: 'bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200',
                dark: 'bg-zinc-100 dark:bg-zinc-800/80 border border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100'
            };

            const solidColors = {
                info: 'bg-blue-600 text-white border border-blue-500 shadow-xl shadow-blue-500/25',
                success: 'bg-emerald-600 text-white border border-emerald-500 shadow-xl shadow-emerald-500/25',
                error: 'bg-rose-600 text-white border border-rose-500 shadow-xl shadow-rose-500/25',
                warning: 'bg-amber-500 text-white border border-amber-400 shadow-xl shadow-amber-500/25',
                dark: 'bg-zinc-900 dark:bg-zinc-800 text-white border border-zinc-700 shadow-xl shadow-zinc-950/30'
            };

            const themeStyle = isSolid ? (solidColors[type] || solidColors.info) : (softColors[type] || softColors.info);
            const textColor = isSolid ? 'text-white' : 'text-zinc-900 dark:text-white';
            const closeBtnColor = isSolid ? 'text-white/70 hover:text-white' : 'text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200';

            const toast = document.createElement('div');
            toast.id = toastId;
            toast.className =
                `${themeStyle} rounded-xl p-4 shadow-lg min-w-[300px] max-w-md transform transition-all duration-300 ease-in-out opacity-0 translate-x-8`;

            const messageLines = message.split('\n');
            toast.innerHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3 mt-0.5">
                        ${icons[type] || icons.info}
                    </div>
                    <div class="flex-1">
                        ${messageLines.map(line => `<p class="text-sm font-semibold ${textColor}">${line}</p>`).join('')}
                    </div>
                    <button onclick="closeToast('${toastId}')" class="ml-2 ${closeBtnColor} transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            `;

            container.appendChild(toast);

            // Force reflow for reliable CSS transition
            void toast.offsetWidth;

            requestAnimationFrame(() => {
                toast.classList.remove('opacity-0', 'translate-x-8');
                toast.classList.add('opacity-100', 'translate-x-0');
            });

            // Auto remove
            if (duration > 0) {
                setTimeout(() => {
                    closeToast(toastId);
                }, duration);
            }
        }

        function closeToast(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.classList.remove('opacity-100', 'translate-x-0');
                toast.classList.add('opacity-0', 'translate-x-8');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        // Global AJAX error handler for 419 CSRF token errors
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ajaxError(function(event, xhr, settings, thrownError) {
                // Handle 419 CSRF token mismatch error
                if (xhr.status === 419) {
                    // Redirect to login page
                    window.location.href = '{{ route('admin.login') }}';
                }
            });
        }

        // Handle axios errors (if axios is available)
        if (window.axios) {
            axios.interceptors.response.use(
                function(response) {
                    return response;
                },
                function(error) {
                    // Handle 419 CSRF token mismatch error
                    if (error.response && error.response.status === 419) {
                        // Redirect to login page
                        window.location.href = '{{ route('admin.login') }}';
                        return Promise.reject(error);
                    }
                    return Promise.reject(error);
                }
            );
        }

        // Clean and reliable theme toggle
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');
            const html = document.getElementById('adminHtml');

            // Get saved theme or default to DB setting
            const dbTheme = '{{ $settings->theme_default ?? "light" }}';
            let savedTheme = localStorage.getItem('adminTheme');
            if (!savedTheme) {
                if (dbTheme === 'system') {
                    savedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                } else {
                    savedTheme = dbTheme;
                }
            }

            // Apply saved theme on load (theme is already applied in head, but sync icons)
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

            // Initialize icons based on saved theme (theme class already applied in head)
            applyTheme(savedTheme);

            // Toggle function
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const isDark = html.classList.contains('dark');
                    const newTheme = isDark ? 'light' : 'dark';

                    applyTheme(newTheme);
                    localStorage.setItem('adminTheme', newTheme);
                    window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme: newTheme } }));
                });
            }
        });

        // Sidebar toggle for desktop & mobile
        const sidebar = document.getElementById('sidebar');
        const toggleSidebarBtn = document.getElementById('toggleSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const html = document.documentElement;

        if (toggleSidebarBtn) {
            toggleSidebarBtn.addEventListener('click', () => {
                if (window.innerWidth >= 1024) {
                    // Desktop toggle using html class
                    const isClosed = html.classList.contains('sidebar-closed');
                    if (isClosed) {
                        html.classList.remove('sidebar-closed');
                        localStorage.setItem('desktopSidebarState', 'open');
                    } else {
                        html.classList.add('sidebar-closed');
                        localStorage.setItem('desktopSidebarState', 'closed');
                    }

                    // Trigger window resize event after transition to fix DataTables/Chart widths
                    setTimeout(() => {
                        window.dispatchEvent(new Event('resize'));
                    }, 310);
                } else {
                    // Mobile toggle
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                }
            });
        }

        function closeMobileSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', closeMobileSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeMobileSidebar);
        }
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('ajaxForm', () => ({
                loading: false,
                async submit(e) {
                    // Sync TinyMCE editors to textareas
                    if (typeof tinymce !== 'undefined') {
                        tinymce.triggerSave();
                    }

                    const form = e.target;
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }
                    this.loading = true;
                    // Remove old errors
                    document.querySelectorAll('.text-red-500.ajax-error').forEach(el => el.remove());
                    
                    try {
                        const formData = new FormData(form);
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                            body: formData,
                        });
                        const data = await response.json();

                        if (response.ok && data.success) {
                            if (typeof showToast === 'function') showToast(data.message, 'success');
                            if (data.redirect) {
                                setTimeout(() => {
                                    const url = new URL(data.redirect, window.location.origin);
                                    url.searchParams.set('_t', Date.now());
                                    window.location.href = url.toString();
                                }, 1000);
                            } else {
                                this.loading = false;
                            }
                        } else if (response.status === 422 && data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const input = form.querySelector(`[name="${field}"]`);
                                if (input) {
                                    const errorEl = document.createElement('p');
                                    errorEl.className = 'text-red-500 text-xs mt-1 ajax-error';
                                    errorEl.textContent = data.errors[field][0];
                                    input.parentNode.appendChild(errorEl);
                                }
                            });
                            if (typeof showToast === 'function') showToast(data.message || 'Please fix the validation errors.', 'error');
                            this.loading = false;
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    } catch (error) {
                        if (typeof showToast === 'function') showToast(error.message || 'Failed to submit form.', 'error');
                        this.loading = false;
                    }
                }
            }));
        });
    </script>
    <x-toast />
    <x-confirm-delete-modal />
    @stack('scripts')
</body>

</html>
