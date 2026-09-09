@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Edit Role</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Update role information, configuration, and assigned permissions</p>
            </div>
            <x-button href="{{ route('admin.roles.index') }}" variant="secondary" icon="arrow-left">
                Back to Roles
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
            $rolePermissionIds = $role->permissions->pluck('id')->toArray();
        @endphp

        <!-- Form Card -->
        <x-card title="Role Information & Access Matrix" subtitle="Update role identification and modify capability permissions across all system modules.">
            <form x-data="ajaxForm" @submit.prevent="submit" action="{{ route('admin.roles.update', $role) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <x-input type="text" name="name" label="Role Name" value="{{ old('name', $role->name) }}" :required="true" placeholder="e.g. Content Manager" hint="Unique identifier name for this role." />
                    </div>
                    <div class="sm:col-span-2">
                        <x-textarea name="description" label="Description" value="{{ old('description', $role->description) }}" placeholder="Brief summary of duties and permissions granted to this role..." hint="Optional description describing the scope of this role." />
                    </div>
                    <div class="sm:col-span-2">
                        <x-toggle name="is_active" label="Role Status" description="When enabled, this role can be assigned to platform users." :checked="old('is_active', $role->is_active)" variant="card" />
                    </div>
                </div>

                <!-- Permissions Matrix -->
                <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xs uppercase tracking-wider font-bold text-zinc-700 dark:text-zinc-300">Permissions Matrix</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Configure the access rights granted to users with this role per module.</p>
                        </div>
                        @if (!$permissions->isEmpty())
                            <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">
                                <input type="checkbox" id="select-all-permissions"
                                    class="w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600">
                                <span>Select All</span>
                            </label>
                        @endif
                    </div>

                    @if ($permissions->isEmpty())
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">No permissions available</p>
                    @else
                        @php
                            $groupedPermissions = $permissions->groupBy('module');
                        @endphp
                        <x-table>
                            <x-slot:header>
                                <tr>
                                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400 w-1/4">Module</th>
                                    <th class="py-3.5 px-4 text-center font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">All</th>
                                    <th class="py-3.5 px-4 text-center font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">View</th>
                                    <th class="py-3.5 px-4 text-center font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Create</th>
                                    <th class="py-3.5 px-4 text-center font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Edit</th>
                                    <th class="py-3.5 px-4 text-center font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Delete</th>
                                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Other</th>
                                </tr>
                            </x-slot:header>

                            @foreach ($groupedPermissions as $module => $modulePermissions)
                                <tr class="bg-white dark:bg-zinc-900 hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors">
                                    <td class="py-3.5 px-4 whitespace-nowrap font-bold text-zinc-900 dark:text-zinc-100 capitalize">
                                        {{ str_replace('_', ' ', $module ?: 'Other') }}
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                        <input type="checkbox" class="select-all-module w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600 cursor-pointer" data-module="{{ $module ?? 'other' }}">
                                    </td>
                                    @php
                                        $getPerm = function($type) use ($modulePermissions) {
                                            return $modulePermissions->first(function($p) use ($type) {
                                                return str_starts_with($p->name, $type . '-') || str_ends_with($p->name, '.' . $type);
                                            });
                                        };
                                        $viewPerm = $getPerm('view');
                                        $createPerm = $getPerm('create');
                                        $editPerm = $getPerm('edit');
                                        $deletePerm = $getPerm('delete');
                                        
                                        $otherPerms = $modulePermissions->filter(function($p) {
                                            return !preg_match('/^(view|create|edit|delete)-/', $p->name) && !preg_match('/\.(view|create|edit|delete)$/', $p->name);
                                        });
                                    @endphp
                                    
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                        @if($viewPerm)
                                            <input type="checkbox" name="permissions[]" value="{{ $viewPerm->id }}"
                                                {{ in_array($viewPerm->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}
                                                class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600 cursor-pointer">
                                        @else
                                            <span class="text-zinc-300 dark:text-zinc-600">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                        @if($createPerm)
                                            <input type="checkbox" name="permissions[]" value="{{ $createPerm->id }}"
                                                {{ in_array($createPerm->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}
                                                class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600 cursor-pointer">
                                        @else
                                            <span class="text-zinc-300 dark:text-zinc-600">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                        @if($editPerm)
                                            <input type="checkbox" name="permissions[]" value="{{ $editPerm->id }}"
                                                {{ in_array($editPerm->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}
                                                class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600 cursor-pointer">
                                        @else
                                            <span class="text-zinc-300 dark:text-zinc-600">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                        @if($deletePerm)
                                            <input type="checkbox" name="permissions[]" value="{{ $deletePerm->id }}"
                                                {{ in_array($deletePerm->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}
                                                class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-zinc-900 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600 cursor-pointer">
                                        @else
                                            <span class="text-zinc-300 dark:text-zinc-600">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($otherPerms->isNotEmpty())
                                            <div class="flex flex-wrap gap-1.5">
                                            @foreach($otherPerms as $perm)
                                                <label class="inline-flex items-center gap-1.5 px-2 py-1 rounded-lg bg-zinc-50 dark:bg-zinc-800/80 border border-zinc-200/80 dark:border-zinc-700/80 cursor-pointer text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-700/60 transition-colors">
                                                    <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                        {{ in_array($perm->id, old('permissions', $rolePermissionIds)) ? 'checked' : '' }}
                                                        class="permission-checkbox module-{{ $module ?? 'other' }} w-3.5 h-3.5 text-emerald-600 bg-white border-zinc-300 rounded focus:ring-emerald-500 dark:bg-zinc-700 dark:border-zinc-600 cursor-pointer">
                                                    <span class="text-[11px] font-medium whitespace-nowrap">{{ str_replace('-', ' ', $perm->name) }}</span>
                                                </label>
                                            @endforeach
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </x-table>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <x-button href="{{ route('admin.roles.index') }}" variant="secondary">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary" :solid="true" x-bind:disabled="loading">
                        <span x-show="!loading">Update Role</span>
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
            const selectAllCheckbox = document.getElementById('select-all-permissions');
            const moduleCheckboxes = document.querySelectorAll('.select-all-module');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

            function updateSelectAllCheckbox() {
                if (selectAllCheckbox) {
                    const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(permissionCheckboxes).some(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = someChecked && !allChecked;
                }
            }

            function updateModuleCheckboxes() {
                moduleCheckboxes.forEach(moduleCheckbox => {
                    const module = moduleCheckbox.getAttribute('data-module');
                    const modulePermissionCheckboxes = document.querySelectorAll(
                        `.permission-checkbox.module-${module}`
                    );
                    const allChecked = Array.from(modulePermissionCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(modulePermissionCheckboxes).some(cb => cb.checked);
                    moduleCheckbox.checked = allChecked;
                    moduleCheckbox.indeterminate = someChecked && !allChecked;
                });
            }

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    permissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
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
                        `.permission-checkbox.module-${module}`
                    );
                    modulePermissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateSelectAllCheckbox();
                });
            });

            permissionCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllCheckbox();
                    updateModuleCheckboxes();
                });
            });

            updateSelectAllCheckbox();
            updateModuleCheckboxes();
        });
    </script>
@endsection
