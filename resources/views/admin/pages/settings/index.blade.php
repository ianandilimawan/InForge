@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="space-y-6" x-data="{
        activeTab: new URLSearchParams(window.location.search).get('tab') || 'general',
        isSubmitting: false,
        submitForm(e) {
            if (this.isSubmitting) return;
            this.isSubmitting = true;
            let form = e.target;
            let formData = new FormData(form);
    
            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                if (response.ok) {
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Settings updated successfully!', type: 'success' } }));
                    setTimeout(() => {
                        window.location.href = form.action + '?tab=' + this.activeTab;
                    }, 1500);
                } else {
                    this.isSubmitting = false;
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Error saving settings.', type: 'error' } }));
                }
            }).catch(error => {
                this.isSubmitting = false;
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'An error occurred.', type: 'error' } }));
            });
        }
    }">

        <!-- Page Header -->
        <div>
            <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Settings</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage your application configuration, email credentials, and branding appearance</p>
        </div>

        <!-- Tabs Navigation -->
        <div class="mb-6">
            <!-- Mobile Select Menu -->
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <select id="tabs" name="tabs" @change="activeTab = $event.target.value; window.history.replaceState(null, null, '?tab=' + $event.target.value)"
                    class="block w-full rounded-xl border border-zinc-200/80 bg-white px-3 py-2 text-zinc-900 shadow-2xs focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/30 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white transition-all text-xs font-semibold">
                    <option value="general" :selected="activeTab === 'general'">General Information</option>
                    <option value="email" :selected="activeTab === 'email'">Email / SMTP Configuration</option>
                    <option value="appearance" :selected="activeTab === 'appearance'">Appearance Settings</option>
                </select>
            </div>
            
            <!-- Desktop Tabs -->
            <div class="hidden sm:block border-b border-zinc-200/80 dark:border-zinc-800 overflow-x-auto">
                <nav class="-mb-px flex gap-6 min-w-max pb-0.5 px-1" aria-label="Tabs">
                    <button @click="activeTab = 'general'; window.history.replaceState(null, null, '?tab=general')"
                        :class="activeTab === 'general' ? 'border-emerald-500 text-emerald-600 dark:text-emerald-400' :
                            'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                        class="whitespace-nowrap py-3 px-1 border-b-2 font-bold text-xs flex items-center gap-2 transition-all duration-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        General
                    </button>
    
                    <button @click="activeTab = 'email'; window.history.replaceState(null, null, '?tab=email')"
                        :class="activeTab === 'email' ? 'border-emerald-500 text-emerald-600 dark:text-emerald-400' :
                            'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                        class="whitespace-nowrap py-3 px-1 border-b-2 font-bold text-xs flex items-center gap-2 transition-all duration-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Email / SMTP
                    </button>
    
                    <button @click="activeTab = 'appearance'; window.history.replaceState(null, null, '?tab=appearance')"
                        :class="activeTab === 'appearance' ? 'border-emerald-500 text-emerald-600 dark:text-emerald-400' :
                            'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300'"
                        class="whitespace-nowrap py-3 px-1 border-b-2 font-bold text-xs flex items-center gap-2 transition-all duration-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                            </path>
                        </svg>
                        Appearance
                    </button>
                </nav>
            </div>
        </div>

        <form x-data="ajaxForm" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
            @submit.prevent="submitForm">
            @csrf
            @method('PUT')

            <input type="hidden" name="active_tab" x-model="activeTab">

            <!-- General Settings Tab -->
            <div x-show="activeTab === 'general'" style="display: none;"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                <x-card title="General Information" subtitle="Basic details about your application and system availability.">
                    <div class="space-y-6 max-w-4xl">
                        <div>
                            <x-input type="text" name="app_name" label="Application Name" value="{{ old('app_name', $setting->app_name) }}" :required="true" placeholder="e.g. My Admin Portal" hint="The application name displayed in headers, navigation, and page titles." />
                        </div>

                        <div>
                            <x-toggle name="maintenance_mode" label="Maintenance Mode" description="Put the application in maintenance mode. Non-admin users will be temporarily locked out." :checked="old('maintenance_mode', $setting->maintenance_mode)" variant="card" />
                        </div>

                        <div class="border-t border-zinc-100 dark:border-zinc-800 pt-6" x-data="{ logoType: '{{ old('logo_type', $setting->logo_type) }}' }">
                            <div class="mb-4">
                                <h4 class="text-xs font-bold text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">Brand Identity</h4>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Configure how your brand appears across the admin panel.</p>
                            </div>

                            <div class="mb-5">
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wider">Logo Type</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-md">
                                    <label
                                        class="flex items-center p-3 border rounded-xl cursor-pointer transition-all shadow-2xs"
                                        :class="logoType === 'text' ?
                                            'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-950/40 text-emerald-900 dark:text-emerald-100 ring-2 ring-emerald-500/20' :
                                            'border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800/40 text-zinc-700 dark:text-zinc-300 hover:bg-white dark:hover:bg-zinc-800'">
                                        <input name="logo_type" type="radio" value="text" x-model="logoType"
                                            class="h-4 w-4 text-emerald-600 border-zinc-300 focus:ring-emerald-500 cursor-pointer">
                                        <span class="ml-2.5 text-xs font-bold">Text Logo</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border rounded-xl cursor-pointer transition-all shadow-2xs"
                                        :class="logoType === 'image' ?
                                            'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-950/40 text-emerald-900 dark:text-emerald-100 ring-2 ring-emerald-500/20' :
                                            'border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800/40 text-zinc-700 dark:text-zinc-300 hover:bg-white dark:hover:bg-zinc-800'">
                                        <input name="logo_type" type="radio" value="image" x-model="logoType"
                                            class="h-4 w-4 text-emerald-600 border-zinc-300 focus:ring-emerald-500 cursor-pointer">
                                        <span class="ml-2.5 text-xs font-bold">Image Logo</span>
                                    </label>
                                </div>
                            </div>

                            <div x-show="logoType === 'text'" style="display: none;" class="mb-5 transition-all duration-300 ease-in-out">
                                <x-input type="text" name="logo_text" label="Logo Text" value="{{ old('logo_text', $setting->logo_text) }}" placeholder="e.g. MyBrand" hint="This text will be rendered in the sidebar header when Text Logo is selected." />
                            </div>

                            <div x-show="logoType === 'image'" style="display: none;" class="mb-5 transition-all duration-300 ease-in-out">
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wider">Application Logo Image</label>
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 h-16 w-36 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-200/80 dark:border-zinc-700 overflow-hidden relative shadow-2xs">
                                        @if ($setting->logo_image)
                                            <img id="logo-preview" src="{{ Storage::url($setting->logo_image) }}" alt="Logo" class="h-full w-full object-contain p-2">
                                        @else
                                            <svg id="logo-placeholder" class="h-6 w-6 text-zinc-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <img id="logo-preview" src="#" alt="Logo Preview" class="h-full w-full object-contain p-2 hidden">
                                        @endif
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <input type="file" name="logo_image" id="logo_image" accept="image/*"
                                            class="block w-full text-xs text-zinc-500 dark:text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-800 dark:file:text-zinc-300 cursor-pointer transition-colors"
                                            onchange="previewImage(this, 'logo-preview', 'logo-placeholder')">
                                        <p class="text-[11px] text-zinc-400 dark:text-zinc-500">PNG, JPG, GIF up to 2MB. Recommended height: 40px.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-zinc-100 dark:border-zinc-800 pt-6">
                                <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wider">Favicon Icon</label>
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 h-14 w-14 bg-zinc-100 dark:bg-zinc-800 rounded-xl flex items-center justify-center border border-zinc-200/80 dark:border-zinc-700 overflow-hidden relative shadow-2xs">
                                        @if ($setting->favicon)
                                            <img id="favicon-preview" src="{{ Storage::url($setting->favicon) }}" alt="Favicon" class="h-8 w-8 object-contain">
                                        @else
                                            <svg id="favicon-placeholder" class="h-5 w-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <img id="favicon-preview" src="#" alt="Favicon Preview" class="h-8 w-8 object-contain hidden">
                                        @endif
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <input type="file" name="favicon" id="favicon" accept="image/x-icon,image/png"
                                            class="block w-full text-xs text-zinc-500 dark:text-zinc-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-800 dark:file:text-zinc-300 cursor-pointer transition-colors"
                                            onchange="previewImage(this, 'favicon-preview', 'favicon-placeholder')">
                                        <p class="text-[11px] text-zinc-400 dark:text-zinc-500">ICO or PNG up to 1MB. Recommended 32x32px or 64x64px.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            <!-- Email Settings Tab -->
            <div x-show="activeTab === 'email'" style="display: none;"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                <x-card title="Email Configuration (SMTP)" subtitle="Configure SMTP relay credentials and outgoing sender identities.">
                    <div class="space-y-6 max-w-4xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <x-input type="text" name="smtp_host" label="SMTP Host" value="{{ old('smtp_host', $setting->smtp_host) }}" placeholder="smtp.mailgun.org" hint="Mail server hostname or IP." />
                            <x-input type="text" name="smtp_port" label="SMTP Port" value="{{ old('smtp_port', $setting->smtp_port) }}" placeholder="587" hint="Usually 587 (TLS) or 465 (SSL)." />
                            <x-input type="text" name="smtp_username" label="SMTP Username" value="{{ old('smtp_username', $setting->smtp_username) }}" placeholder="username@domain.com" />
                            <x-password name="smtp_password" label="SMTP Password" value="{{ old('smtp_password', $setting->smtp_password) }}" placeholder="••••••••" />
                            
                            <div class="sm:col-span-2">
                                <label for="smtp_encryption" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5 uppercase tracking-wider">Encryption Method</label>
                                <select id="smtp_encryption" name="smtp_encryption"
                                    class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 cursor-pointer transition-colors">
                                    <option value="" {{ old('smtp_encryption', $setting->smtp_encryption) == '' ? 'selected' : '' }}>None</option>
                                    <option value="tls" {{ old('smtp_encryption', $setting->smtp_encryption) == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ old('smtp_encryption', $setting->smtp_encryption) == 'ssl' ? 'selected' : '' }}>SSL</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                            <h4 class="text-xs font-bold text-zinc-700 dark:text-zinc-300 uppercase tracking-wider mb-4">Sender Information</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <x-input type="email" name="smtp_from_address" label="From Email Address" value="{{ old('smtp_from_address', $setting->smtp_from_address) }}" placeholder="noreply@example.com" hint="Default email address used as sender." />
                                <x-input type="text" name="smtp_from_name" label="From Display Name" value="{{ old('smtp_from_name', $setting->smtp_from_name) }}" placeholder="My Application" hint="The sender name displayed in user email clients." />
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            <!-- Appearance Settings Tab -->
            <div x-show="activeTab === 'appearance'" style="display: none;"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
                <x-card title="Appearance Settings" subtitle="Customize default theme modes and layout behaviors for new visitors.">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-4xl">
                        <div>
                            <label for="theme_default" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5 uppercase tracking-wider">Default Theme Mode</label>
                            <select id="theme_default" name="theme_default"
                                class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 cursor-pointer transition-colors">
                                <option value="system" {{ old('theme_default', $setting->theme_default) == 'system' ? 'selected' : '' }}>System Default (Matches OS)</option>
                                <option value="light" {{ old('theme_default', $setting->theme_default) == 'light' ? 'selected' : '' }}>Light Mode</option>
                                <option value="dark" {{ old('theme_default', $setting->theme_default) == 'dark' ? 'selected' : '' }}>Dark Mode</option>
                            </select>
                            <p class="mt-1.5 text-[11px] text-zinc-400 dark:text-zinc-500">Users can still override this locally using the theme switch.</p>
                        </div>

                        <div>
                            <label for="sidebar_style" class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-1.5 uppercase tracking-wider">Sidebar Default Layout</label>
                            <select id="sidebar_style" name="sidebar_style"
                                class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 cursor-pointer transition-colors">
                                <option value="full" {{ old('sidebar_style', $setting->sidebar_style) == 'full' ? 'selected' : '' }}>Full / Expanded</option>
                                <option value="collapsed" {{ old('sidebar_style', $setting->sidebar_style) == 'collapsed' ? 'selected' : '' }}>Collapsed / Minimized</option>
                            </select>
                            <p class="mt-1.5 text-[11px] text-zinc-400 dark:text-zinc-500">Sets the initial width state of the left navigation menu.</p>
                        </div>
                    </div>
                </x-card>
            </div>

            <!-- Submit button -->
            <div class="flex justify-end pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <x-button type="submit" variant="primary" :solid="true" :disabled="'isSubmitting'" x-bind:disabled="isSubmitting">
                    <span x-show="!isSubmitting" class="inline-flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Save Configuration</span>
                    </span>
                    <span x-show="isSubmitting" style="display: none;" class="inline-flex items-center gap-1.5">
                        <svg class="animate-spin h-3.5 w-3.5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Saving...</span>
                    </span>
                </x-button>
            </div>

        </form>
    </div>

    <script>
        function previewImage(input, previewId, placeholderId) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
