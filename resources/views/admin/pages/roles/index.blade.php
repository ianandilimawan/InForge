@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Roles</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage user roles and authorization permissions</p>
            </div>
            @if (auth()->user() && auth()->user()->hasPermission('create-roles'))
                <x-button href="{{ route('admin.roles.create') }}" variant="primary" :solid="true" icon="plus">
                    Add Role
                </x-button>
            @endif
        </div>

        <!-- Roles Table -->
        <livewire:tables.role-table />
    </div>
@endsection
