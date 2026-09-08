@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, success, info, warning
    'size' => 'md',
    'href' => null,
])

@php
    $variantClasses = match($variant) {
        'primary', 'success' => 'text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60',
        'secondary', 'neutral' => 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 hover:bg-zinc-200/80 dark:hover:bg-zinc-700/80 border border-zinc-200/60 dark:border-zinc-700/60',
        'danger' => 'text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200/60 dark:border-rose-800/60',
        'info', 'blue' => 'text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-950/60 hover:bg-blue-100 dark:hover:bg-blue-900/60 border border-blue-200/60 dark:border-blue-800/60',
        'warning', 'amber' => 'text-amber-700 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 bg-amber-50 dark:bg-amber-950/60 hover:bg-amber-100 dark:hover:bg-amber-900/60 border border-amber-200/60 dark:border-amber-800/60',
        default => 'text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60',
    };

    $sizeClasses = match($size) {
        'sm' => 'px-2.5 py-1 text-[11px]',
        'lg' => 'px-4 py-2 text-xs',
        default => 'px-3 py-1.5 text-xs',
    };

    $baseClasses = 'inline-flex items-center justify-center gap-1.5 font-bold rounded-xl transition-all cursor-pointer shadow-2xs focus:outline-none';
    $classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
