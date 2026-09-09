@extends('admin.layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div>
        <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Account Profile</h1>
        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage your personal profile, contact information, and security credentials</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Profile Form -->
        <div class="lg:col-span-2">
            <x-card title="Profile Information" subtitle="Update your profile photo, display name, and email address.">
                <form x-data="ajaxForm" @submit.prevent="submit" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-2 uppercase tracking-wider">Profile Avatar</label>
                            <div class="flex items-center gap-5">
                                <div class="w-20 h-20 rounded-2xl overflow-hidden bg-zinc-100 dark:bg-zinc-800 border border-zinc-200/80 dark:border-zinc-700 shadow-2xs shrink-0">
                                    @if($user->avatar)
                                        <img src="{{ Storage::url($user->avatar) }}" id="avatarPreview" alt="Preview" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=18181b&background=f4f4f5" id="avatarPreview" alt="Preview" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1 space-y-1.5">
                                    <input type="file" name="avatar" id="avatar" accept="image/*" class="block w-full text-xs text-zinc-500 dark:text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-800 dark:file:text-zinc-300 dark:hover:file:bg-zinc-700 transition-all cursor-pointer" onchange="previewImage(event)">
                                    <p class="text-[11px] text-zinc-400 dark:text-zinc-500">JPG, GIF, or PNG format. Max file size: 2MB.</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <x-input type="text" name="name" label="Full Name" value="{{ old('name', $user->name) }}" :required="true" placeholder="e.g. John Doe" hint="Your display name as shown across the administration panel." />
                            <x-input type="email" name="email" label="Email Address" value="{{ old('email', $user->email) }}" :required="true" placeholder="john.doe@example.com" hint="Primary email address for system notifications and login." />
                        </div>
                    </div>

                    <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 flex justify-end">
                        <x-button type="submit" variant="primary" :solid="true" x-bind:disabled="loading">
                            <span x-show="!loading">Save Profile Changes</span>
                            <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                                <svg class="animate-spin h-3.5 w-3.5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>

        <!-- Security Form -->
        <div class="lg:col-span-1">
            <x-card title="Change Password" subtitle="Ensure your account is protected with a secure password.">
                <form x-data="ajaxForm" @submit.prevent="submit" action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-password name="current_password" label="Current Password" :required="true" placeholder="••••••••" hint="Enter your existing password for verification." />
                        <p id="current_password_hint" class="text-xs mt-1.5 font-medium hidden"></p>
                    </div>

                    <div>
                        <x-password name="password" label="New Password" :strength="true" :required="true" placeholder="••••••••" hint="Minimum 8 characters with letters, numbers, and symbols." />
                    </div>

                    <div>
                        <x-password name="password_confirmation" label="Confirm New Password" :required="true" placeholder="••••••••" hint="Re-type your new password to verify." />
                        <p id="password_match_hint" class="text-xs mt-1.5 font-medium hidden"></p>
                    </div>

                    <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                        <x-button type="submit" variant="primary" :solid="true" class="w-full justify-center" x-bind:disabled="loading">
                            <span x-show="!loading">Update Password</span>
                            <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                                <svg class="animate-spin h-3.5 w-3.5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Updating...
                            </span>
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>

    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Current Password AJAX Check
    let currentPasswordTimeout;
    const currentPasswordInput = document.getElementById('current_password');
    const currentPasswordHint = document.getElementById('current_password_hint');
    
    if (currentPasswordInput) {
        currentPasswordInput.addEventListener('input', function() {
            clearTimeout(currentPasswordTimeout);
            const val = this.value;
            if (!val) {
                currentPasswordHint.classList.add('hidden');
                return;
            }
            
            currentPasswordTimeout = setTimeout(() => {
                fetch('{{ route('admin.profile.check-password') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ current_password: val })
                })
                .then(res => res.json())
                .then(data => {
                    currentPasswordHint.classList.remove('hidden');
                    if (data.match) {
                        currentPasswordHint.textContent = 'Current password is correct.';
                        currentPasswordHint.className = 'text-xs mt-1.5 font-medium text-emerald-600 dark:text-emerald-400';
                    } else {
                        currentPasswordHint.textContent = 'Current password does not match.';
                        currentPasswordHint.className = 'text-xs mt-1.5 font-medium text-rose-600 dark:text-rose-400';
                    }
                });
            }, 500);
        });
    }

    // Password Confirmation Match Check
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const matchHint = document.getElementById('password_match_hint');

    function checkMatch() {
        if (!passwordInput || !confirmInput || !matchHint) return;
        const val1 = passwordInput.value;
        const val2 = confirmInput.value;
        
        if (!val2) {
            matchHint.classList.add('hidden');
            return;
        }
        
        matchHint.classList.remove('hidden');
        if (val1 === val2) {
            matchHint.textContent = 'Passwords match.';
            matchHint.className = 'text-xs mt-1.5 font-medium text-emerald-600 dark:text-emerald-400';
        } else {
            matchHint.textContent = 'Passwords do not match.';
            matchHint.className = 'text-xs mt-1.5 font-medium text-rose-600 dark:text-rose-400';
        }
    }

    if (passwordInput && confirmInput) {
        passwordInput.addEventListener('input', checkMatch);
        confirmInput.addEventListener('input', checkMatch);
    }
</script>
@endsection
