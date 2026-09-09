@props([
    'title',
    'value',
    'icon' => null,
    'trend' => null,
    'trendType' => null, // 'up', 'down', 'neutral'
    'trendLabel' => 'vs last month',
    'color' => 'primary', // 'primary', 'blue', 'purple', 'rose', 'amber'
    'progress' => null,
    'progressLabel' => null,
    'badge' => null,
    'class' => '',
])

@php
    $isPositive = $trendType === 'up' || ($trendType === null && str_starts_with((string)$trend, '+'));
    $isNegative = $trendType === 'down' || ($trendType === null && str_starts_with((string)$trend, '-'));

    $iconBgClass = match($color) {
        'blue', 'sky' => 'bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 border-blue-200/60 dark:border-blue-800/60',
        'purple', 'violet' => 'bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 border-purple-200/60 dark:border-purple-800/60',
        'rose', 'danger', 'red' => 'bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 border-rose-200/60 dark:border-rose-800/60',
        'amber', 'warning', 'yellow' => 'bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 border-amber-200/60 dark:border-amber-800/60',
        default => 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 border-emerald-200/60 dark:border-emerald-800/60',
    };

    $progressBarClass = match($color) {
        'blue', 'sky' => 'bg-blue-500',
        'purple', 'violet' => 'bg-purple-500',
        'rose', 'danger', 'red' => 'bg-rose-500',
        'amber', 'warning', 'yellow' => 'bg-amber-500',
        default => 'bg-emerald-500',
    };
@endphp

<div {{ $attributes->merge(['class' => "bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 rounded-2xl p-5 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-md transition-all duration-200 relative overflow-hidden group {$class}"]) }}>
    <div class="flex items-start justify-between gap-4">
        <div class="space-y-1.5 flex-1 min-w-0">
            <div class="flex items-center gap-2">
                <span class="text-xs uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400 truncate">
                    {{ $title }}
                </span>
                @if ($badge)
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300">
                        {{ $badge }}
                    </span>
                @endif
            </div>
            <div class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white truncate">
                {{ $value }}
            </div>
        </div>

        @if ($icon || $iconSlot ?? false)
            <div class="w-10 h-10 rounded-xl border flex items-center justify-center shrink-0 {{ $iconBgClass }} transition-transform duration-200 group-hover:scale-105">
                @if ($iconSlot ?? false)
                    {{ $iconSlot }}
                @elseif ($icon === 'dollar' || $icon === 'currency')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif ($icon === 'users')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                @elseif ($icon === 'shopping-cart' || $icon === 'cart' || $icon === 'orders')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                @elseif ($icon === 'activity' || $icon === 'trending-up')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                @elseif ($icon === 'server' || $icon === 'cpu')
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                @else
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                @endif
            </div>
        @endif
    </div>

    @if ($trend !== null)
        <div class="mt-3.5 pt-3 border-t border-zinc-100 dark:border-zinc-800/80 flex items-center justify-between text-xs">
            <div class="flex items-center gap-1.5">
                @if ($isPositive)
                    <span class="inline-flex items-center gap-0.5 font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-1.5 py-0.5 rounded-md border border-emerald-200/60 dark:border-emerald-800/60 text-[11px]">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        {{ $trend }}
                    </span>
                @elseif ($isNegative)
                    <span class="inline-flex items-center gap-0.5 font-bold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 px-1.5 py-0.5 rounded-md border border-rose-200/60 dark:border-rose-800/60 text-[11px]">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        {{ $trend }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-0.5 font-bold text-zinc-600 dark:text-zinc-400 bg-zinc-100 dark:bg-zinc-800 px-1.5 py-0.5 rounded-md text-[11px]">
                        {{ $trend }}
                    </span>
                @endif
                <span class="text-zinc-500 dark:text-zinc-400 text-[11px]">
                    {{ $trendLabel }}
                </span>
            </div>
            @if ($slot->isNotEmpty())
                <div>{{ $slot }}</div>
            @endif
        </div>
    @elseif ($progress !== null)
        <div class="mt-3.5 pt-3 border-t border-zinc-100 dark:border-zinc-800/80 space-y-1.5">
            <div class="flex items-center justify-between text-[11px]">
                <span class="text-zinc-500 dark:text-zinc-400 font-medium">{{ $progressLabel ?? 'Target Completion' }}</span>
                <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $progress }}%</span>
            </div>
            <div class="w-full h-1.5 rounded-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
                <div class="h-full rounded-full transition-all duration-500 {{ $progressBarClass }}" style="width: {{ min(100, max(0, (int)$progress)) }}%"></div>
            </div>
        </div>
    @elseif ($slot->isNotEmpty())
        <div class="mt-3.5 pt-3 border-t border-zinc-100 dark:border-zinc-800/80">
            {{ $slot }}
        </div>
    @endif
</div>
