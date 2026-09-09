@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Users</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Manage your platform users and their roles</p>
            </div>
            @if (auth()->user() && auth()->user()->hasPermission('create-users'))
                <x-button href="{{ route('admin.users.create') }}" variant="primary" :solid="true" icon="plus">
                    Add User
                </x-button>
            @endif
        </div>

        <!-- Users Table -->
        <livewire:tables.user-table />
    </div>
@endsection
