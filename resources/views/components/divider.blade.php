@props([
    'label' => null,
    'badge' => null,
    'icon' => null,
    'align' => 'center',
    'dashed' => false,
    'class' => '',
])

@php
    $borderStyle = $dashed ? 'border-dashed' : 'border-solid';
    $lineClasses = "flex-1 border-t border-zinc-200 dark:border-zinc-800 {$borderStyle}";

    $alignClasses = [
        'center' => 'justify-center',
        'left' => 'justify-start',
        'right' => 'justify-end',
    ][$align] ?? 'justify-center';
@endphp

<div {{ $attributes->merge(['class' => "relative flex items-center my-6 {$class}"]) }}>
    @if ($align === 'center' || $align === 'right')
        <div class="{{ $lineClasses }}"></div>
    @endif

    @if ($label || $badge || $icon || isset($iconSlot) || !$slot->isEmpty())
        <div class="px-3 flex items-center gap-2 text-xs font-semibold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider select-none shrink-0">
            @if ($icon)
                @if ($icon === 'plus')
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                @elseif ($icon === 'check')
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                @elseif ($icon === 'lock')
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                @elseif ($icon === 'star')
                    <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                @else
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                @endif
            @elseif (isset($iconSlot))
                {{ $iconSlot }}
            @endif

            @if ($label)
                <span>{{ $label }}</span>
            @endif

            @if ($badge)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold tracking-normal uppercase bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 border border-zinc-200/60 dark:border-zinc-700/60">
                    {{ $badge }}
                </span>
            @endif

            {{ $slot }}
        </div>
    @endif

    @if ($align === 'center' || $align === 'left')
        <div class="{{ $lineClasses }}"></div>
    @endif
</div>
