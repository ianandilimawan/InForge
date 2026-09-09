@props([
    'value' => 0,
    'label' => null,
    'showValue' => true,
    'size' => 'md', // 'sm', 'md', 'lg'
    'color' => 'primary', // 'primary', 'blue', 'purple', 'rose', 'amber'
    'striped' => false,
    'animated' => false,
    'class' => '',
])

@php
    $clampedValue = min(100, max(0, (int)$value));

    $heightClass = match($size) {
        'sm' => 'h-1.5',
        'lg' => 'h-4 text-[10px]',
        default => 'h-2.5 text-[9px]',
    };

    $colorClass = match($color) {
        'blue', 'sky' => 'bg-blue-600',
        'purple', 'violet' => 'bg-purple-600',
        'rose', 'danger', 'red' => 'bg-rose-600',
        'amber', 'warning', 'yellow' => 'bg-amber-500',
        default => 'bg-emerald-600',
    };

    $stripeClass = $striped ? 'bg-[linear-gradient(45deg,rgba(255,255,255,0.15)_25%,transparent_25%,transparent_50%,rgba(255,255,255,0.15)_50%,rgba(255,255,255,0.15)_75%,transparent_75%,transparent)] bg-[length:1rem_1rem]' : '';
    $animClass = ($striped && $animated) ? 'animate-[progress-bar-stripes_1s_linear_infinite]' : '';
@endphp

<div class="space-y-1.5 {{ $class }}">
    @if ($label || $showValue)
        <div class="flex items-center justify-between text-xs">
            @if ($label)
                <span class="font-bold text-zinc-700 dark:text-zinc-300">{{ $label }}</span>
            @endif
            @if ($showValue)
                <span class="font-mono font-bold text-zinc-500 dark:text-zinc-400">{{ $clampedValue }}%</span>
            @endif
        </div>
    @endif

    <div class="w-full bg-zinc-100 dark:bg-zinc-800 rounded-full overflow-hidden {{ $heightClass }}">
        <div class="{{ $heightClass }} rounded-full transition-all duration-500 {{ $colorClass }} {{ $stripeClass }} {{ $animClass }} flex items-center justify-center font-bold text-white"
            role="progressbar"
            style="width: {{ $clampedValue }}%"
            aria-valuenow="{{ $clampedValue }}"
            aria-valuemin="0"
            aria-valuemax="100">
            @if ($size === 'lg' && $clampedValue >= 15)
                <span>{{ $clampedValue }}%</span>
            @endif
        </div>
    </div>
</div>
