@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Server Logs</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Real-time log viewer and exception diagnostics</p>
            </div>
        </div>

        <!-- Layout Grid -->
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Sidebar: Log Files -->
            <div class="w-full lg:w-1/3 xl:w-1/4 flex-shrink-0">
                <div x-data="{ open: window.innerWidth >= 1024 }" @resize.window="if (window.innerWidth >= 1024) open = true" class="bg-white dark:bg-zinc-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-zinc-200/80 dark:border-zinc-800 overflow-hidden sticky top-6">
                    <!-- Mobile Toggle Button -->
                    <button @click="open = !open" class="lg:hidden w-full px-4 py-3.5 flex items-center justify-between border-b border-zinc-200/80 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800/50 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span class="text-xs font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Log Files Directory</span>
                        </div>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 text-zinc-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <!-- Desktop Header (Hidden on Mobile) -->
                    <div class="hidden lg:flex px-4 py-3.5 border-b border-zinc-200/80 dark:border-zinc-800 bg-white/95 dark:bg-zinc-900/95 backdrop-blur-sm items-center gap-2">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <h2 class="text-xs font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Log Files</h2>
                    </div>

                    <!-- Files List -->
                    <div x-show="open" x-collapse class="max-h-[calc(100vh-12rem)] overflow-y-auto custom-scrollbar p-3 space-y-4">
                        @if (count($logFiles) > 0)
                            @foreach ($groupedLogFiles as $group)
                                <div>
                                    <h3 class="px-2 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1.5 flex items-center">
                                        @if ($group['date'])
                                            {{ $group['date_formatted'] }}
                                            @if ($group['date'] === date('Y-m-d'))
                                                <span class="ml-2 px-1.5 py-0.5 text-[9px] bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400 rounded-md font-bold">Today</span>
                                            @endif
                                        @else
                                            {{ $group['date_formatted'] }}
                                        @endif
                                    </h3>
                                    <ul class="space-y-1">
                                        @foreach ($group['files'] as $file)
                                            <li>
                                                <a href="{{ route('admin.laravel-logs.index', ['file' => $file['name']]) }}"
                                                    class="group flex items-center justify-between px-3 py-2 rounded-xl transition-all border {{ $selectedFile === $file['name'] ? 'bg-emerald-50/80 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border-emerald-200/80 dark:border-emerald-800/60 font-semibold' : 'border-transparent text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100/80 dark:hover:bg-zinc-800/60 hover:text-zinc-900 dark:hover:text-zinc-100' }}">
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-xs truncate">
                                                            {{ $file['name'] }}
                                                        </p>
                                                        <p class="text-[10px] mt-0.5 {{ $selectedFile === $file['name'] ? 'text-emerald-600/70 dark:text-emerald-400/70' : 'text-zinc-400 dark:text-zinc-500' }}">
                                                            {{ $file['size_human'] }} &bull; {{ date('H:i', strtotime($file['modified_human'])) }}
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <div class="px-2 py-6 text-center">
                                <svg class="w-8 h-8 mx-auto text-zinc-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="text-xs text-zinc-400 dark:text-zinc-500">No log files found</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content: Log Entries -->
            <div class="w-full lg:w-2/3 xl:w-3/4 flex-1">
                @if ($selectedFile && $logData)
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden border border-zinc-200/80 dark:border-zinc-800 flex flex-col h-full lg:max-h-[calc(100vh-8rem)]">

                        <!-- Sticky Header & Filters -->
                        <div class="sticky top-0 z-20 bg-white/95 dark:bg-zinc-900/95 backdrop-blur-sm border-b border-zinc-200/80 dark:border-zinc-800 px-5 py-3.5">
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <h2 class="text-sm font-bold text-zinc-900 dark:text-white truncate font-mono" title="{{ $selectedFile }}">
                                        {{ $selectedFile }}
                                    </h2>
                                    <!-- Clear File Button -->
                                    <form x-data="ajaxForm" @submit.prevent="submit" method="POST" action="{{ route('admin.laravel-logs.clear', $selectedFile) }}" class="inline m-0" onsubmit="return confirm('Are you sure you want to clear this log file?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-zinc-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/30 rounded-lg transition-colors cursor-pointer" title="Clear this log file" x-bind:disabled="loading">
                                            <span x-show="!loading"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></span>
                                            <span x-show="loading" style="display: none;">
                                                <svg class="animate-spin h-4 w-4 text-zinc-500 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                </div>

                                <!-- Filters -->
                                <form x-data="ajaxForm" @submit.prevent="submit" method="GET" action="{{ route('admin.laravel-logs.index') }}" class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                                    <input type="hidden" name="file" value="{{ $selectedFile }}">

                                    <div class="flex-1 md:w-36">
                                        <x-select name="level" placeholder="All Levels" :value="request('level')">
                                            @foreach ($levels as $logLevel)
                                                <option value="{{ $logLevel }}" {{ request('level') === $logLevel ? 'selected' : '' }}>
                                                    {{ $logLevel }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                    </div>

                                    <div class="flex-1 md:w-48">
                                        <x-input type="text" name="search" value="{{ request('search') }}" placeholder="Search messages..." />
                                    </div>

                                    <x-button type="submit" variant="primary" :solid="true" size="xl" class="h-[42px] px-4 text-xs sm:text-sm font-bold" x-bind:disabled="loading">
                                        <span x-show="!loading">Filter</span>
                                        <span x-show="loading" style="display: none;" class="inline-flex items-center gap-1.5">
                                            <svg class="animate-spin h-3.5 w-3.5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>
                                    </x-button>

                                    @if (request()->anyFilled(['level', 'search']))
                                        <x-button href="{{ route('admin.laravel-logs.index', ['file' => $selectedFile]) }}" variant="secondary" size="xl" class="h-[42px] px-4 text-xs sm:text-sm font-bold">
                                            Clear
                                        </x-button>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <!-- Log Entries List (Scrollable Area) -->
                        <div class="flex-1 overflow-y-auto custom-scrollbar p-0 bg-white dark:bg-zinc-900">
                            @if (count($logData['entries']) > 0)
                                <div class="divide-y divide-zinc-100 dark:divide-zinc-800/80">
                                    @foreach ($logData['entries'] as $index => $entry)
                                        @php
                                            $isError = in_array(strtoupper($entry['level']), ['ERROR', 'EMERGENCY', 'CRITICAL', 'ALERT']);
                                            $isWarning = strtoupper($entry['level']) === 'WARNING';
                                            $isInfo = in_array(strtoupper($entry['level']), ['INFO', 'NOTICE']);
                                            $levelVariant = match(true) {
                                                $isError => 'rose',
                                                $isWarning => 'amber',
                                                $isInfo => 'blue',
                                                default => 'zinc',
                                            };
                                        @endphp
                                        <div x-data="{ expanded: false }" class="p-4 bg-white dark:bg-zinc-900 hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors">
                                            <div class="flex items-start gap-3">
                                                <!-- Badge & Timestamp -->
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 mb-1.5">
                                                        <x-badge :variant="$levelVariant" size="sm" :dot="true">
                                                            {{ $entry['level'] }}
                                                        </x-badge>
                                                        <span class="text-xs text-zinc-400 dark:text-zinc-500 font-mono">
                                                            {{ $entry['timestamp'] }}
                                                        </span>
                                                        @if ($entry['environment'])
                                                            <span class="hidden sm:inline-block px-1.5 py-0.2 rounded text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-500 uppercase">
                                                                {{ $entry['environment'] }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="text-xs text-zinc-900 dark:text-zinc-100 font-mono break-all sm:break-words whitespace-pre-wrap leading-relaxed" :class="{'line-clamp-2': !expanded && {{ !empty($entry['stack']) ? 'true' : 'false' }} }">{{ $entry['message'] }}</div>

                                                    @if (!empty($entry['stack']))
                                                        <div x-show="expanded" x-collapse class="mt-3">
                                                            <div class="relative bg-zinc-950 rounded-xl p-4 font-mono text-[11px] leading-relaxed text-zinc-300 overflow-x-auto custom-scrollbar border border-zinc-800 shadow-inner group/stack">
                                                                <button @click="navigator.clipboard.writeText($refs.stack_{{ $index }}.innerText); $el.innerText = 'Copied!'; setTimeout(() => $el.innerText = 'Copy', 2000)" class="absolute top-2.5 right-2.5 px-2 py-1 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 rounded-md text-[10px] font-medium opacity-0 group-hover/stack:opacity-100 transition-opacity cursor-pointer">
                                                                    Copy
                                                                </button>
                                                                <pre x-ref="stack_{{ $index }}">{{ $entry['stack'] }}</pre>
                                                            </div>
                                                        </div>

                                                        <button @click="expanded = !expanded" class="mt-2 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 flex items-center gap-1 focus:outline-none cursor-pointer">
                                                            <span x-text="expanded ? 'Hide Stack Trace' : 'Show Stack Trace'"></span>
                                                            <svg :class="{'rotate-180': expanded}" class="w-3.5 h-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-16 px-4 text-center h-full">
                                    <div class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-1">No log entries found</h3>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500 max-w-sm">
                                        @if (request()->anyFilled(['level', 'search']))
                                            Try adjusting your filters or search query.
                                        @else
                                            This log file is currently empty.
                                        @endif
                                    </p>
                                    @if (request()->anyFilled(['level', 'search']))
                                        <x-button href="{{ route('admin.laravel-logs.index', ['file' => $selectedFile]) }}" variant="secondary" size="sm" class="mt-4">
                                            Clear Filters
                                        </x-button>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Pagination Footer -->
                        @if ($logData && $logData['last_page'] > 1)
                            <div class="border-t border-zinc-200/80 dark:border-zinc-800 bg-white dark:bg-zinc-900 px-5 py-3 flex items-center justify-between">
                                <div class="hidden sm:block text-xs text-zinc-500 dark:text-zinc-400">
                                    Showing <span class="font-bold text-zinc-900 dark:text-white">{{ ($logData['current_page'] - 1) * $logData['per_page'] + 1 }}</span> to
                                    <span class="font-bold text-zinc-900 dark:text-white">{{ min($logData['current_page'] * $logData['per_page'], $logData['total']) }}</span> of
                                    <span class="font-bold text-zinc-900 dark:text-white">{{ $logData['total'] }}</span> entries
                                </div>
                                <div class="flex gap-2 w-full sm:w-auto justify-between sm:justify-end">
                                    @if ($logData['current_page'] > 1)
                                        <x-button href="{{ route('admin.laravel-logs.index', array_merge(request()->only(['file', 'level', 'search']), ['page' => $logData['current_page'] - 1])) }}" variant="secondary" size="sm">
                                            &larr; Previous
                                        </x-button>
                                    @else
                                        <x-button disabled variant="secondary" size="sm" class="opacity-50 cursor-not-allowed">
                                            &larr; Previous
                                        </x-button>
                                    @endif

                                    @if ($logData['current_page'] < $logData['last_page'])
                                        <x-button href="{{ route('admin.laravel-logs.index', array_merge(request()->only(['file', 'level', 'search']), ['page' => $logData['current_page'] + 1])) }}" variant="secondary" size="sm">
                                            Next &rarr;
                                        </x-button>
                                    @else
                                        <x-button disabled variant="secondary" size="sm" class="opacity-50 cursor-not-allowed">
                                            Next &rarr;
                                        </x-button>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @elseif ($selectedFile)
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-12 text-center border border-zinc-200/80 dark:border-zinc-800">
                        <div class="w-14 h-14 bg-zinc-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-1">Empty Log File</h3>
                        <p class="text-xs text-zinc-400 dark:text-zinc-500">This log file has no entries recorded yet.</p>
                    </div>
                @else
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-12 text-center border border-zinc-200/80 dark:border-zinc-800">
                        <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-950/40 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                        </div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-1">Select a Log File</h3>
                        <p class="text-xs text-zinc-400 dark:text-zinc-500">Choose a log file from the left sidebar to inspect events and exceptions.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d4d4d8;
            border-radius: 20px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #3f3f46;
        }
    </style>
@endsection
