@props([
    'variant' => 'primary', // primary, secondary, danger, warning, info, purple
    'size' => 'md',        // sm, md, lg
    'dot' => false,
    'rounded' => 'rounded-xl',
])

@php
    $variantClasses = match($variant) {
        'primary', 'success', 'emerald' => 'text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 border-emerald-200/60 dark:border-emerald-800/60',
        'secondary', 'neutral', 'zinc', 'gray' => 'text-zinc-600 dark:text-zinc-400 bg-zinc-100/80 dark:bg-zinc-800/80 border-zinc-200/60 dark:border-zinc-700/60',
        'danger', 'rose', 'red' => 'text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/60 border-rose-200/60 dark:border-rose-800/60',
        'info', 'blue' => 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/60 border-blue-200/60 dark:border-blue-800/60',
        'warning', 'amber', 'yellow' => 'text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/60 border-amber-200/60 dark:border-amber-800/60',
        'purple', 'violet', 'indigo' => 'text-purple-700 dark:text-purple-300 bg-purple-50 dark:bg-purple-950/60 border-purple-200/60 dark:border-purple-800/60',
        default => 'text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 border-emerald-200/60 dark:border-emerald-800/60',
    };

    $dotColorClasses = match($variant) {
        'primary', 'success', 'emerald' => 'bg-emerald-500',
        'secondary', 'neutral', 'zinc', 'gray' => 'bg-zinc-400',
        'danger', 'rose', 'red' => 'bg-rose-500',
        'info', 'blue' => 'bg-blue-500',
        'warning', 'amber', 'yellow' => 'bg-amber-500',
        'purple', 'violet', 'indigo' => 'bg-purple-500',
        default => 'bg-emerald-500',
    };

    $sizeClasses = match($size) {
        'sm' => 'px-2 py-0.5 text-[10px]',
        'lg' => 'px-3 py-1 text-xs',
        default => 'px-2.5 py-0.5 text-xs',
    };

    $classes = "inline-flex items-center gap-1.5 font-bold border {$variantClasses} {$sizeClasses} {$rounded} shadow-2xs select-none";
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColorClasses }}"></span>
    @endif
    {{ $slot }}
</span>
