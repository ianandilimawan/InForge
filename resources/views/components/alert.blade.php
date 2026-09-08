@props([
    'variant' => 'info', // info, success, warning, danger
    'title' => null,
    'dismissible' => false,
    'icon' => true,
])

@php
    $variantConfig = match($variant) {
        'success', 'emerald' => [
            'box' => 'bg-emerald-50 dark:bg-emerald-950/40 border-emerald-200/60 dark:border-emerald-800/60 text-emerald-800 dark:text-emerald-300',
            'title' => 'text-emerald-900 dark:text-emerald-200',
            'icon' => 'text-emerald-600 dark:text-emerald-400',
            'close' => 'text-emerald-600 hover:bg-emerald-100 dark:hover:bg-emerald-900/60',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        ],
        'danger', 'error', 'rose' => [
            'box' => 'bg-rose-50 dark:bg-rose-950/40 border-rose-200/60 dark:border-rose-800/60 text-rose-800 dark:text-rose-300',
            'title' => 'text-rose-900 dark:text-rose-200',
            'icon' => 'text-rose-600 dark:text-rose-400',
            'close' => 'text-rose-600 hover:bg-rose-100 dark:hover:bg-rose-900/60',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        ],
        'warning', 'amber' => [
            'box' => 'bg-amber-50 dark:bg-amber-950/40 border-amber-200/60 dark:border-amber-800/60 text-amber-800 dark:text-amber-300',
            'title' => 'text-amber-900 dark:text-amber-200',
            'icon' => 'text-amber-600 dark:text-amber-400',
            'close' => 'text-amber-600 hover:bg-amber-100 dark:hover:bg-amber-900/60',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
        ],
        default => [
            'box' => 'bg-blue-50 dark:bg-blue-950/40 border-blue-200/60 dark:border-blue-800/60 text-blue-800 dark:text-blue-300',
            'title' => 'text-blue-900 dark:text-blue-200',
            'icon' => 'text-blue-600 dark:text-blue-400',
            'close' => 'text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/60',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        ],
    };
@endphp

<div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
    {{ $attributes->merge(['class' => "p-4 rounded-xl border {$variantConfig['box']} relative flex items-start gap-3 text-xs leading-relaxed"]) }}>
    @if ($icon)
        <div class="shrink-0 mt-0.5 {{ $variantConfig['icon'] }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $variantConfig['svg'] !!}
            </svg>
        </div>
    @endif

    <div class="flex-1">
        @if ($title)
            <h4 class="font-bold text-xs {{ $variantConfig['title'] }} mb-0.5">{{ $title }}</h4>
        @endif
        <div>
            {{ $slot }}
        </div>
    </div>

    @if ($dismissible)
        <button type="button" @click="show = false" class="p-1 -mr-1 -mt-1 rounded-lg {{ $variantConfig['close'] }} transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    @endif
</div>
