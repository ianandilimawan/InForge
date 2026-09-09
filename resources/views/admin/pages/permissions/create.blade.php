@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Create Permission</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Add a new capability flag and authorization permission to the system</p>
            </div>
            <x-button href="{{ route('admin.permissions.index') }}" variant="secondary" icon="arrow-left">
                Back to Permissions
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

        <!-- Form Card -->
        <x-card title="Permission Configuration" subtitle="Configure permission identifier, module categorization, and system status.">
            <form x-data="ajaxForm" @submit.prevent="submit" action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Basic Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-input type="text" name="name" label="Permission Name" value="{{ old('name') }}" :required="true" placeholder="e.g. Create Users" hint="Descriptive label for this permission." />
                    <x-input type="text" name="slug" label="Permission Slug" value="{{ old('slug') }}" :required="true" placeholder="e.g. create-users" hint="Lowercase string with hyphens used in authorization checks." />
                    <div class="sm:col-span-2">
                        <x-input type="text" name="module" label="Module Category" value="{{ old('module') }}" placeholder="e.g. users, settings, roles" hint="System module grouping category for organizing permissions." />
                    </div>
                    <div class="sm:col-span-2">
                        <x-textarea name="description" label="Description" value="{{ old('description') }}" placeholder="Describe the access rights and operations granted by this permission..." hint="Optional explanation of what this permission allows." />
                    </div>
                    <div class="sm:col-span-2">
                        <x-toggle name="is_active" label="Permission Status" description="When active, this permission can be assigned to roles and checked in policy guards." :checked="old('is_active', true)" variant="card" />
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <x-button href="{{ route('admin.permissions.index') }}" variant="secondary">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary" :solid="true" x-bind:disabled="loading">
                        <span x-show="!loading">Create Permission</span>
                        <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                            <svg class="animate-spin h-3.5 w-3.5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                        </span>
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
