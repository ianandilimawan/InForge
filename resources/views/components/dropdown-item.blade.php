@props([
    'href' => null,
    'icon' => null,
    'danger' => false,
    'disabled' => false,
    'divider' => false,
])

@if ($divider)
    <div class="my-1 border-t border-zinc-100 dark:border-zinc-800"></div>
@else
    @php
        $baseClasses = 'w-full flex items-center gap-2.5 px-3.5 py-2 text-xs font-medium rounded-lg transition-colors cursor-pointer text-left';
        $colorClasses = $danger 
            ? 'text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40' 
            : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white';
        $disabledClasses = 'opacity-50 cursor-not-allowed pointer-events-none';
        $classes = "{$baseClasses} {$colorClasses} " . ($disabled ? $disabledClasses : '');
    @endphp

    @if ($href)
        <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
            @if ($icon)
                <span class="w-4 h-4 shrink-0 text-zinc-400 dark:text-zinc-500 group-hover:text-current">{!! $icon !!}</span>
            @endif
            <span class="flex-1 truncate">{{ $slot }}</span>
        </a>
    @else
        <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
            @if ($icon)
                <span class="w-4 h-4 shrink-0 text-zinc-400 dark:text-zinc-500 group-hover:text-current">{!! $icon !!}</span>
            @endif
            <span class="flex-1 truncate">{{ $slot }}</span>
        </button>
    @endif
@endif
