@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Log Viewer</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Inspecting file: <code class="font-mono text-zinc-800 dark:text-zinc-200">{{ $fileName }}</code></p>
            </div>
            <x-button href="{{ route('admin.laravel-logs.index', ['file' => $fileName]) }}" variant="secondary" icon="arrow-left">
                Back to Logs
            </x-button>
        </div>

        <!-- Filters -->
        <x-card title="Filter Entries" subtitle="Filter log events in this file by severity level or message text.">
            <form x-data="ajaxForm" @submit.prevent="submit" method="GET" action="{{ route('admin.laravel-logs.show', $fileName) }}" class="flex flex-wrap items-center gap-3">
                <div class="w-full sm:w-44">
                    <x-select name="level" placeholder="All Levels" :value="request('level')">
                        @foreach ($levels as $logLevel)
                            <option value="{{ $logLevel }}" {{ request('level') === $logLevel ? 'selected' : '' }}>
                                {{ $logLevel }}
                            </option>
                        @endforeach
                    </x-select>
                </div>

                <div class="flex-1 min-w-[220px]">
                    <x-input type="text" name="search" value="{{ request('search') }}" placeholder="Search log message..." />
                </div>

                <div class="flex items-center gap-2">
                    <x-button type="submit" variant="primary" :solid="true" x-bind:disabled="loading">
                        <span x-show="!loading">Filter</span>
                        <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                            <svg class="animate-spin h-3.5 w-3.5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </x-button>

                    @if (request()->anyFilled(['level', 'search']))
                        <x-button href="{{ route('admin.laravel-logs.show', $fileName) }}" variant="secondary">
                            Clear
                        </x-button>
                    @endif
                </div>
            </form>
        </x-card>

        <!-- Log Entries Card -->
        <x-card :title="'Log Entries: ' . $fileName" subtitle="Viewing recent error traces and diagnostic payloads.">
            @if (count($logData['entries']) > 0)
                <div class="space-y-3">
                    @foreach ($logData['entries'] as $index => $entry)
                        @php
                            $isError = in_array(strtoupper($entry['level']), ['ERROR', 'EMERGENCY', 'CRITICAL', 'ALERT']);
                            $isWarning = strtoupper($entry['level']) === 'WARNING';
                            $isInfo = in_array(strtoupper($entry['level']), ['INFO', 'NOTICE']);
                            $variant = match(true) {
                                $isError => 'rose',
                                $isWarning => 'amber',
                                $isInfo => 'blue',
                                default => 'zinc',
                            };
                        @endphp
                        <div class="border border-zinc-200/80 dark:border-zinc-800 rounded-xl p-4 bg-white dark:bg-zinc-900 hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors">
                            <div class="flex items-center gap-3 mb-2 flex-wrap">
                                <x-badge :variant="$variant" size="sm" :dot="true">
                                    {{ $entry['level'] }}
                                </x-badge>
                                <span class="text-xs text-zinc-400 dark:text-zinc-500 font-mono">
                                    {{ $entry['timestamp'] }}
                                </span>
                                @if ($entry['environment'])
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-500 uppercase">
                                        {{ $entry['environment'] }}
                                    </span>
                                @endif
                            </div>

                            <p class="text-xs text-zinc-900 dark:text-zinc-100 font-mono break-words leading-relaxed">
                                {{ $entry['message'] }}
                            </p>

                            @if (!empty($entry['stack']))
                                <details class="mt-3 group">
                                    <summary class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 cursor-pointer hover:underline list-none flex items-center gap-1">
                                        <svg class="w-3 h-3 group-open:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        <span>Stack Trace</span>
                                    </summary>
                                    <pre class="mt-2 p-3 bg-zinc-950 rounded-xl overflow-x-auto text-[11px] text-zinc-300 font-mono whitespace-pre-wrap border border-zinc-800 custom-scrollbar leading-relaxed">{{ $entry['stack'] }}</pre>
                                </details>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($logData['last_page'] > 1)
                    <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400">
                            Showing {{ ($logData['current_page'] - 1) * $logData['per_page'] + 1 }} to
                            {{ min($logData['current_page'] * $logData['per_page'], $logData['total']) }} of
                            {{ $logData['total'] }} entries
                        </div>

                        <div class="flex gap-2">
                            @if ($logData['current_page'] > 1)
                                <x-button href="{{ route('admin.laravel-logs.show', array_merge(['fileName' => $fileName], request()->only(['level', 'search']), ['page' => $logData['current_page'] - 1])) }}" variant="secondary" size="sm">
                                    &larr; Previous
                                </x-button>
                            @endif

                            @if ($logData['current_page'] < $logData['last_page'])
                                <x-button href="{{ route('admin.laravel-logs.show', array_merge(['fileName' => $fileName], request()->only(['level', 'search']), ['page' => $logData['current_page'] + 1])) }}" variant="secondary" size="sm">
                                    Next &rarr;
                                </x-button>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-8">
                    <p class="text-xs text-zinc-400 dark:text-zinc-500">
                        No log entries found
                        @if (request()->anyFilled(['level', 'search']))
                            matching the active filter.
                        @endif
                    </p>
                </div>
            @endif
        </x-card>
    </div>
@endsection
