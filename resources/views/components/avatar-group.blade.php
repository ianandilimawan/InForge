@props([
    'excess' => null,
    'size' => 'md',
    'class' => '',
])

@php
    $excessSize = match($size) {
        'xs' => 'w-6 h-6 text-[9px]',
        'sm' => 'w-8 h-8 text-[11px]',
        'lg' => 'w-12 h-12 text-sm',
        default => 'w-10 h-10 text-xs',
    };
@endphp

<div class="flex items-center -space-x-2.5 overflow-hidden hover:space-x-1 transition-all duration-200 {{ $class }}">
    {{ $slot }}

    @if ($excess)
        <div class="{{ $excessSize }} rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 font-bold flex items-center justify-center ring-2 ring-white dark:ring-zinc-900 shadow-sm shrink-0 border border-zinc-200/80 dark:border-zinc-700/80 select-none">
            +{{ $excess }}
        </div>
    @endif
</div>
