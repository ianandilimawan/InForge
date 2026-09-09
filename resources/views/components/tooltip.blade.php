@props([
    'text',
    'position' => 'top',
    'class' => '',
])

@php
    $positions = [
        'top' => 'bottom-full left-1/2 -translate-x-1/2 mb-2',
        'bottom' => 'top-full left-1/2 -translate-x-1/2 mt-2',
        'left' => 'right-full top-1/2 -translate-y-1/2 mr-2',
        'right' => 'left-full top-1/2 -translate-y-1/2 ml-2',
    ];
    $posClass = $positions[$position] ?? $positions['top'];

    $arrows = [
        'top' => 'top-full left-1/2 -translate-x-1/2 border-t-zinc-900 dark:border-t-zinc-800 border-x-transparent border-b-transparent border-4',
        'bottom' => 'bottom-full left-1/2 -translate-x-1/2 border-b-zinc-900 dark:border-b-zinc-800 border-x-transparent border-t-transparent border-4',
        'left' => 'left-full top-1/2 -translate-y-1/2 border-l-zinc-900 dark:border-l-zinc-800 border-y-transparent border-r-transparent border-4',
        'right' => 'right-full top-1/2 -translate-y-1/2 border-r-zinc-900 dark:border-r-zinc-800 border-y-transparent border-l-transparent border-4',
    ];
    $arrowClass = $arrows[$position] ?? $arrows['top'];
@endphp

<div
    x-data="{ show: false }"
    @mouseenter="show = true"
    @mouseleave="show = false"
    @focusin="show = true"
    @focusout="show = false"
    class="relative inline-flex {{ $class }}"
    {{ $attributes }}
>
    {{ $slot }}

    <div
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 {{ $posClass }} pointer-events-none whitespace-nowrap"
        role="tooltip"
    >
        <div class="px-2.5 py-1 text-xs font-medium text-white bg-zinc-900 dark:bg-zinc-800 rounded-lg shadow-lg border border-zinc-700/50">
            {{ $text }}
        </div>
        <div class="absolute w-0 h-0 {{ $arrowClass }}"></div>
    </div>
</div>
