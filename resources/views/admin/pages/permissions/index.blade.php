@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Permissions</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage system access permissions and capability flags</p>
            </div>
            @if (auth()->user() && auth()->user()->hasPermission('create-permissions'))
                <x-button href="{{ route('admin.permissions.create') }}" variant="primary" :solid="true" icon="plus">
                    Add Permission
                </x-button>
            @endif
        </div>

        <!-- Permissions Table -->
        <livewire:tables.permission-table />
    </div>
@endsection
