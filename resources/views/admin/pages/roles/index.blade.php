@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Roles</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage user roles and permissions</p>
            </div>
            @if (auth()->user() && auth()->user()->hasPermission('create-roles'))
                <a href="{{ route('admin.roles.create') }}"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60 rounded-xl transition-all cursor-pointer shadow-2xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Add Role</span>
                </a>
            @endif
        </div>

<!-- Roles Table -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50 dark:border-gray-800 overflow-hidden p-2">
            <livewire:tables.role-table />
        </div>
    </div>
@endsection
