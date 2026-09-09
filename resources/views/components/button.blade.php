@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, success, info, warning, purple, dark, outline, ghost
    'style' => 'outline',   // 'outline' (soft badge) or 'solid' (high-contrast filled)
    'solid' => false,       // boolean convenience flag for style="solid"
    'size' => 'md',         // xs, sm, md, lg, xl
    'href' => null,
    'icon' => null,
    'iconRight' => null,
    'loading' => false,
    'loadingText' => null,
    'fullWidth' => false,
    'disabled' => false,
])

@php
    $isSolid = $solid || $style === 'solid' || str_starts_with($variant, 'solid');
    $cleanVariant = str_replace('solid-', '', $variant);

    if ($isSolid) {
        $variantClasses = match($cleanVariant) {
            'primary', 'success', 'emerald' => 'text-white bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 border border-emerald-600 hover:border-emerald-700 shadow-sm',
            'secondary', 'neutral', 'zinc', 'gray' => 'text-white bg-zinc-700 hover:bg-zinc-800 active:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 border border-zinc-700 dark:border-zinc-600 shadow-sm',
            'danger', 'rose', 'red' => 'text-white bg-rose-600 hover:bg-rose-700 active:bg-rose-800 border border-rose-600 hover:border-rose-700 shadow-sm',
            'info', 'blue' => 'text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 border border-blue-600 hover:border-blue-700 shadow-sm',
            'warning', 'amber', 'yellow' => 'text-white bg-amber-500 hover:bg-amber-600 active:bg-amber-700 border border-amber-500 hover:border-amber-600 shadow-sm',
            'purple', 'violet', 'indigo' => 'text-white bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 border border-indigo-600 hover:border-indigo-700 shadow-sm',
            'dark', 'black' => 'text-white bg-zinc-900 hover:bg-zinc-800 active:bg-black dark:bg-zinc-800 dark:text-white dark:hover:bg-zinc-700 border border-zinc-900 dark:border-zinc-700 shadow-sm',
            default => 'text-white bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 border border-emerald-600 shadow-sm',
        };
    } else {
        $variantClasses = match($cleanVariant) {
            'primary', 'success', 'emerald' => 'text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60',
            'secondary', 'neutral', 'zinc', 'gray' => 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 hover:bg-zinc-200/80 dark:hover:bg-zinc-700/80 border border-zinc-200/60 dark:border-zinc-700/60',
            'danger', 'rose', 'red' => 'text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200/60 dark:border-rose-800/60',
            'info', 'blue' => 'text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 bg-blue-50 dark:bg-blue-950/60 hover:bg-blue-100 dark:hover:bg-blue-900/60 border border-blue-200/60 dark:border-blue-800/60',
            'warning', 'amber', 'yellow' => 'text-amber-700 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 bg-amber-50 dark:bg-amber-950/60 hover:bg-amber-100 dark:hover:bg-amber-900/60 border border-amber-200/60 dark:border-amber-800/60',
            'purple', 'violet', 'indigo' => 'text-purple-700 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-200 bg-purple-50 dark:bg-purple-950/60 hover:bg-purple-100 dark:hover:bg-purple-900/60 border border-purple-200/60 dark:border-purple-800/60',
            'dark', 'black' => 'text-zinc-700 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 border border-zinc-300 dark:border-zinc-600',
            'outline' => 'text-zinc-700 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white bg-transparent hover:bg-zinc-100 dark:hover:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700',
            'ghost' => 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-transparent hover:bg-zinc-100 dark:hover:bg-zinc-800 border-transparent',
            default => 'text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/60 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/60 dark:border-emerald-800/60',
        };
    }

    $sizeClasses = match($size) {
        'xs' => 'px-2 py-0.5 text-[10px]',
        'sm' => 'px-2.5 py-1 text-[11px]',
        'lg' => 'px-4 py-2 text-xs',
        'xl' => 'px-5 py-2.5 text-sm',
        default => 'px-3 py-1.5 text-xs',
    };

    $iconSize = match($size) {
        'xs' => 'w-3 h-3',
        'sm' => 'w-3.5 h-3.5',
        'lg' => 'w-4 h-4',
        'xl' => 'w-4 h-4',
        default => 'w-3.5 h-3.5',
    };

    $baseClasses = 'inline-flex items-center justify-center gap-1.5 font-bold rounded-xl transition-all cursor-pointer shadow-2xs focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none select-none';
    $widthClass = $fullWidth ? 'w-full' : '';
    $classes = trim("{$baseClasses} {$variantClasses} {$sizeClasses} {$widthClass}");
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            {!! \App\Helpers\MenuHelper::renderIcon($icon, $iconSize) !!}
        @endif
        @if(trim($slot))
            <span>{{ $slot }}</span>
        @endif
        @if($iconRight)
            {!! \App\Helpers\MenuHelper::renderIcon($iconRight, $iconSize) !!}
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            {!! \App\Helpers\MenuHelper::renderIcon($icon, $iconSize) !!}
        @endif
        @if(trim($slot))
            <span>{{ $slot }}</span>
        @endif
        @if($iconRight)
            {!! \App\Helpers\MenuHelper::renderIcon($iconRight, $iconSize) !!}
        @endif
    </button>
@endif
