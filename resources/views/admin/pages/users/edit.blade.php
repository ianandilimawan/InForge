@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Edit User</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Update user profile information, authentication credentials, and access rights</p>
            </div>
            <x-button href="{{ route('admin.users.index') }}" variant="secondary" icon="arrow-left">
                Back to Users
            </x-button>
        </div>

        @if ($errors->any())
            <x-alert type="danger" title="Validation Errors">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        @php
            $userRole = $user->roles->first();
            $isSuperAdmin = $userRole && $userRole->name === 'super-admin';
            $userPermissionIds = $user->permissions->pluck('id')->toArray();
            $userRoleId = $userRole?->id;
        @endphp

        <!-- Form Card -->
        <x-card title="User Details & Credentials" subtitle="Modify personal profile, update password, and manage role-based permissions.">
            <form x-data="ajaxForm" @submit.prevent="submit" action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Info -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-input type="text" name="name" label="Full Name" value="{{ old('name', $user->name) }}" :required="true" placeholder="e.g. John Doe" hint="The user's full name as displayed across the platform." />
                    <x-input type="email" name="email" label="Email Address" value="{{ old('email', $user->email) }}" :required="true" placeholder="john.doe@example.com" hint="Active email address used for login and notifications." />
                </div>

                <!-- Password Info -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-password name="password" label="New Password (optional)" :strength="true" placeholder="••••••••" hint="Leave blank to keep current password. Minimum 8 characters if changing." />
                    <x-password name="password_confirmation" label="Confirm New Password" placeholder="••••••••" hint="Re-enter the new password if you provided one." />
                </div>

                <!-- Roles Assignment -->
                <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 space-y-3">
                    <div>
                        <h3 class="text-xs uppercase tracking-wider font-bold text-zinc-700 dark:text-zinc-300">Assign Role</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Select a role for this user. Built-in permissions from this role will be checked automatically.</p>
                    </div>

                    @if ($roles->isEmpty())
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">No roles available</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach ($roles as $role)
                                <label class="flex items-center p-3 rounded-xl border border-zinc-200/80 dark:border-zinc-700/80 bg-zinc-50/60 dark:bg-zinc-800/40 hover:bg-white dark:hover:bg-zinc-800 hover:border-emerald-500/50 cursor-pointer transition-all role-radio shadow-2xs"
                                    data-role-id="{{ $role->id }}"
                                    data-role-permissions="{{ $role->permissions->pluck('id')->toJson() }}">
                                    <input type="radio" name="role" value="{{ $role->id }}"
                                        {{ old('role', $userRoleId) == $role->id ? 'checked' : '' }}
                                        class="w-4 h-4 text-emerald-600 bg-white border-zinc-300 focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600">
                                    <span class="ml-2.5 text-xs font-bold text-zinc-800 dark:text-zinc-200">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Permissions Assignment -->
                <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xs uppercase tracking-wider font-bold text-zinc-700 dark:text-zinc-300">Granular Permissions</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Assign additional capability permissions beyond default role access.</p>
                        </div>
                        @if (!$permissions->isEmpty() && !$isSuperAdmin)
                            <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">
                                <input type="checkbox" id="select-all-permissions"
                                    class="w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600">
                                <span>Select All</span>
                            </label>
                        @endif
                    </div>

                    @if ($isSuperAdmin)
                        <x-alert type="info" title="Super Admin Account">
                            This user has the <strong>Super Admin</strong> role with full unrestricted system access. All permissions are automatically active.
                        </x-alert>
                    @endif

                    @if ($permissions->isEmpty())
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">No permissions available</p>
                    @else
                        @php
                            $groupedPermissions = $permissions->groupBy('module');
                        @endphp
                        <div class="space-y-4 max-h-96 overflow-y-auto border border-zinc-200/80 dark:border-zinc-800 rounded-2xl p-4 bg-zinc-50/50 dark:bg-zinc-900/50 custom-scrollbar">
                            @foreach ($groupedPermissions as $module => $modulePermissions)
                                <div class="pb-4 border-b border-zinc-200/60 dark:border-zinc-800 last:border-b-0 last:pb-0">
                                    <div class="flex items-center justify-between mb-2.5">
                                        <h4 class="text-xs font-bold text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                                            {{ str_replace('_', ' ', $module ?: 'Other') }}
                                        </h4>
                                        @if (!$isSuperAdmin)
                                            <label class="flex items-center gap-1.5 cursor-pointer text-[11px] font-medium text-zinc-500 dark:text-zinc-400 hover:text-zinc-800 dark:hover:text-zinc-200">
                                                <input type="checkbox"
                                                    class="select-all-module w-3.5 h-3.5 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:bg-zinc-700 dark:border-zinc-600"
                                                    data-module="{{ $module ?? 'other' }}">
                                                <span>Select Module</span>
                                            </label>
                                        @endif
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                                        @foreach ($modulePermissions as $permission)
                                            <label class="flex items-center p-2 rounded-xl transition-colors {{ !$isSuperAdmin ? 'hover:bg-white dark:hover:bg-zinc-800 cursor-pointer border border-transparent hover:border-zinc-200/80 dark:hover:border-zinc-700/80' : 'opacity-60 cursor-not-allowed' }} permission-checkbox"
                                                data-module="{{ $module ?? 'other' }}">
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}"
                                                    {{ $isSuperAdmin || in_array($permission->id, old('permissions', $userPermissionIds)) ? 'checked' : '' }}
                                                    {{ $isSuperAdmin ? 'disabled' : '' }}
                                                    class="w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600 {{ $isSuperAdmin ? 'cursor-not-allowed' : '' }}">
                                                <span class="ml-2 text-xs font-medium text-zinc-700 dark:text-zinc-300">{{ str_replace('-', ' ', $permission->name) }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <x-button href="{{ route('admin.users.index') }}" variant="secondary">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary" :solid="true" x-bind:disabled="loading">
                        <span x-show="!loading">Update User</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllPermissions = document.getElementById('select-all-permissions');
            const moduleCheckboxes = document.querySelectorAll('.select-all-module');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
            const roleRadios = document.querySelectorAll('input[name="role"]');

            function updateSelectAllPermissions() {
                if (selectAllPermissions) {
                    const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(permissionCheckboxes).some(cb => cb.checked);
                    selectAllPermissions.checked = allChecked;
                    selectAllPermissions.indeterminate = someChecked && !allChecked;
                }
            }

            function updateModuleCheckboxes() {
                moduleCheckboxes.forEach(moduleCheckbox => {
                    const module = moduleCheckbox.getAttribute('data-module');
                    const modulePermissionCheckboxes = document.querySelectorAll(
                        `.permission-checkbox[data-module="${module}"] input[type="checkbox"]`
                    );
                    const allChecked = Array.from(modulePermissionCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(modulePermissionCheckboxes).some(cb => cb.checked);
                    moduleCheckbox.checked = allChecked;
                    moduleCheckbox.indeterminate = someChecked && !allChecked;
                });
            }

            roleRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        const roleLabel = this.closest('label.role-radio');
                        const rolePermissionsJson = roleLabel.getAttribute('data-role-permissions');

                        if (rolePermissionsJson && rolePermissionsJson !== '[]' && rolePermissionsJson.trim() !== '') {
                            try {
                                const rolePermissions = JSON.parse(rolePermissionsJson);
                                permissionCheckboxes.forEach(checkbox => {
                                    if (rolePermissions.includes(parseInt(checkbox.value))) {
                                        checkbox.checked = true;
                                    }
                                });
                                updateSelectAllPermissions();
                                updateModuleCheckboxes();
                            } catch (e) {
                                console.error('Error parsing role permissions:', e);
                            }
                        }
                    }
                });
            });

            if (selectAllPermissions) {
                selectAllPermissions.addEventListener('change', function() {
                    permissionCheckboxes.forEach(checkbox => {
                        if (!checkbox.disabled) checkbox.checked = this.checked;
                    });
                    moduleCheckboxes.forEach(moduleCheckbox => {
                        moduleCheckbox.checked = this.checked;
                    });
                });
            }

            moduleCheckboxes.forEach(moduleCheckbox => {
                moduleCheckbox.addEventListener('change', function() {
                    const module = this.getAttribute('data-module');
                    const modulePermissionCheckboxes = document.querySelectorAll(
                        `.permission-checkbox[data-module="${module}"] input[type="checkbox"]:not(:disabled)`
                    );
                    modulePermissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateSelectAllPermissions();
                });
            });

            permissionCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllPermissions();
                    updateModuleCheckboxes();
                });
            });

            updateSelectAllPermissions();
            updateModuleCheckboxes();
        });
    </script>
@endsection
