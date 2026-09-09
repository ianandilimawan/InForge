@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Activity Logs</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Audit trail and record of all user activities and system events</p>
            </div>
        </div>

        <!-- Filters Card -->
        <x-card title="Filter Activities" subtitle="Refine logs by action type, target model, or keyword search.">
            <form x-data="ajaxForm" @submit.prevent="submit" method="GET" action="{{ route('admin.activity-logs.index') }}"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                <x-select name="action" label="Action" placeholder="All Actions" :value="request('action')">
                    @foreach ($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                            {{ ucfirst($action) }}
                        </option>
                    @endforeach
                </x-select>

                <x-select name="model_type" label="Model Type" placeholder="All Models" :value="request('model_type')">
                    @foreach ($modelTypes as $modelType)
                        <option value="{{ $modelType }}" {{ request('model_type') == $modelType ? 'selected' : '' }}>
                            {{ class_basename($modelType) }}
                        </option>
                    @endforeach
                </x-select>

                <div>
                    <x-input type="text" name="search" label="Search Keyword" value="{{ request('search') }}" placeholder="Search description..." />
                </div>
                <div class="flex items-center gap-2 w-full">
                    <x-button type="submit" variant="primary" :solid="true" size="xl" class="flex-1 justify-center h-[42px] text-xs sm:text-sm font-bold" x-bind:disabled="loading">
                        <span x-show="!loading" class="inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span>Filter Logs</span>
                        </span>
                        <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                            <svg class="animate-spin h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Filtering...</span>
                        </span>
                    </x-button>
                    @if (request()->anyFilled(['action', 'model_type', 'search']))
                        <x-button href="{{ route('admin.activity-logs.index') }}" variant="secondary" size="xl" class="h-[42px] px-4 text-xs sm:text-sm font-bold">
                            Clear
                        </x-button>
                    @endif
                </div>
            </form>
        </x-card>

        <!-- Activity Logs Table -->
        <x-table>
            <x-slot:header>
                <tr>
                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Action
                    </th>
                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Model
                    </th>
                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Description
                    </th>
                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        User
                    </th>
                    <th class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Timestamp
                    </th>
                    <th class="py-3.5 px-4 text-right font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Actions
                    </th>
                </tr>
            </x-slot:header>

            @forelse($activityLogs as $log)
                <tr class="bg-white dark:bg-zinc-900 hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors">
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        @php
                            $variant = match(strtolower($log->action)) {
                                'create' => 'emerald',
                                'update' => 'blue',
                                'delete' => 'rose',
                                default => 'zinc'
                            };
                        @endphp
                        <x-badge :variant="$variant" size="sm" :dot="true">
                            {{ ucfirst($log->action) }}
                        </x-badge>
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        <div class="font-bold text-zinc-900 dark:text-zinc-100">
                            {{ class_basename($log->model_type) }}
                        </div>
                        @if ($log->model_id)
                            <div class="text-[11px] text-zinc-400 dark:text-zinc-500 font-mono">
                                #{{ $log->model_id }}
                            </div>
                        @endif
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="text-zinc-800 dark:text-zinc-200 max-w-md truncate">
                            {{ Str::limit($log->description, 60) }}
                        </div>
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        @if ($log->user)
                            <div class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $log->user->name }}</div>
                            <div class="text-[11px] text-zinc-400 dark:text-zinc-500">{{ $log->user->email }}</div>
                        @else
                            <span class="text-zinc-400 dark:text-zinc-500 italic">System</span>
                        @endif
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap">
                        <div class="text-zinc-800 dark:text-zinc-200">
                            {{ $log->created_at->format('Y-m-d H:i:s') }}
                        </div>
                        <div class="text-[11px] text-zinc-400 dark:text-zinc-500">
                            {{ $log->created_at->diffForHumans() }}
                        </div>
                    </td>
                    <td class="py-3.5 px-4 whitespace-nowrap text-right">
                        <a href="{{ route('admin.activity-logs.show', $log) }}"
                            class="inline-flex items-center justify-center p-1.5 rounded-lg text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors"
                            title="View Details">
                            <span class="sr-only">View Details</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-zinc-400 dark:text-zinc-500 text-xs">
                        No activity logs found matching the filter criteria.
                    </td>
                </tr>
            @endforelse

            @if ($activityLogs->hasPages())
                <x-slot:footer>
                    <div class="w-full">
                        {{ $activityLogs->links() }}
                    </div>
                </x-slot:footer>
            @endif
        </x-table>
    </div>
@endsection
