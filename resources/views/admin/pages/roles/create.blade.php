@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Create Role</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Add a new role to the system</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 dark:bg-red-900 border-2 border-red-600 dark:border-red-600 shadow-sm rounded-xl p-4">
                <ul class="text-sm text-red-900 dark:text-red-200 font-semibold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
            <form x-data="ajaxForm" @submit.prevent="submit" action="{{ route('admin.roles.store') }}" method="POST" class="lg:p-8 px-4 py-4 space-y-6">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <x-input-floating type="text" name="name" label="Name" value="{{ old('name') }}" required="true" />
                </div>

                <!-- Description -->
                <div>
                    <x-textarea-floating name="description" label="Description" value="{{ old('description') }}" />
                </div>

                <!-- Is Active -->
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Active</span>
                    </label>
                </div>

                <!-- Permissions -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Permissions</label>
                        @if (!$permissions->isEmpty())
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" id="select-all-permissions"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Select All</span>
                            </label>
                        @endif
                    </div>
                    <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
                        @if ($permissions->isEmpty())
                            <p class="text-sm text-gray-500 dark:text-gray-400 p-4">No permissions available</p>
                        @else
                            @php
                                $groupedPermissions = $permissions->groupBy('module');
                            @endphp
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">Module</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">All</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">View</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Create</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Edit</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Delete</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Other</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($groupedPermissions as $module => $modulePermissions)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-200 capitalize">
                                                {{ str_replace('_', ' ', $module ?: 'Other') }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                <input type="checkbox" class="select-all-module w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-900 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer" data-module="{{ $module ?? 'other' }}">
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
                                            
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                @if($viewPerm)
                                                    <input type="checkbox" name="permissions[]" value="{{ $viewPerm->id }}"
                                                        {{ in_array($viewPerm->id, old('permissions', [])) ? 'checked' : '' }}
                                                        class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-900 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                @else
                                                    <span class="text-gray-300 dark:text-gray-600">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                @if($createPerm)
                                                    <input type="checkbox" name="permissions[]" value="{{ $createPerm->id }}"
                                                        {{ in_array($createPerm->id, old('permissions', [])) ? 'checked' : '' }}
                                                        class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-900 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                @else
                                                    <span class="text-gray-300 dark:text-gray-600">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                @if($editPerm)
                                                    <input type="checkbox" name="permissions[]" value="{{ $editPerm->id }}"
                                                        {{ in_array($editPerm->id, old('permissions', [])) ? 'checked' : '' }}
                                                        class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-900 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                @else
                                                    <span class="text-gray-300 dark:text-gray-600">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center">
                                                @if($deletePerm)
                                                    <input type="checkbox" name="permissions[]" value="{{ $deletePerm->id }}"
                                                        {{ in_array($deletePerm->id, old('permissions', [])) ? 'checked' : '' }}
                                                        class="permission-checkbox module-{{ $module ?? 'other' }} w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-900 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                @else
                                                    <span class="text-gray-300 dark:text-gray-600">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($otherPerms->isNotEmpty())
                                                    <div class="flex flex-wrap gap-2">
                                                    @foreach($otherPerms as $perm)
                                                        <label class="inline-flex items-center cursor-pointer bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-2 py-1 rounded">
                                                            <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                                {{ in_array($perm->id, old('permissions', [])) ? 'checked' : '' }}
                                                                class="permission-checkbox module-{{ $module ?? 'other' }} w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-900 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                            <span class="ml-1.5 text-xs text-gray-700 dark:text-gray-300 whitespace-nowrap">{{ str_replace('-', ' ', $perm->name) }}</span>
                                                        </label>
                                                    @endforeach
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Select which permissions this role should have
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-zinc-100 dark:border-zinc-800 mt-6">
                    <a href="{{ route('admin.roles.index') }}"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 hover:bg-zinc-200/80 dark:hover:bg-zinc-700/80 border border-zinc-200/60 dark:border-zinc-700/60 rounded-xl transition-all cursor-pointer shadow-2xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60 rounded-xl transition-all cursor-pointer shadow-2xs"
                        x-bind:disabled="loading">
                        <span x-show="!loading">Create Role</span>
                        <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                            <svg class="animate-spin h-3.5 w-3.5 text-emerald-700 dark:text-emerald-300 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const selectAllCheckbox = document.getElementById('select-all-permissions');
            const moduleCheckboxes = document.querySelectorAll('.select-all-module');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

            // Select All functionality
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    permissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });

                    // Update module checkboxes
                    moduleCheckboxes.forEach(moduleCheckbox => {
                        moduleCheckbox.checked = this.checked;
                    });
                });
            }

            // Module Select All functionality
            moduleCheckboxes.forEach(moduleCheckbox => {
                moduleCheckbox.addEventListener('change', function() {
                    const module = this.getAttribute('data-module');
                    const modulePermissionCheckboxes = document.querySelectorAll(
                        `.permission-checkbox.module-${module}`
                    );

                    modulePermissionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });

                    // Update main select all checkbox
                    updateSelectAllCheckbox();
                });
            });

            // Update main select all checkbox
            function updateSelectAllCheckbox() {
                if (selectAllCheckbox) {
                    const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
                    const someChecked = Array.from(permissionCheckboxes).some(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = someChecked && !allChecked;
                }
            }

            // Update module checkboxes
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

            // Individual checkbox change
            permissionCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllCheckbox();
                    updateModuleCheckboxes();
                });
            });

            // Initialize checkboxes state
            updateSelectAllCheckbox();
            updateModuleCheckboxes();
        });
    </script>
@endsection
