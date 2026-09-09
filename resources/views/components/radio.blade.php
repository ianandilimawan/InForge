@props([
    'name',
    'value',
    'id' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
    'disabled' => false,
    'variant' => 'default', // 'default' or 'card'
    'color' => 'primary',   // 'primary', 'blue', 'purple', 'rose', 'amber', 'dark'
    'badge' => null,
    'class' => '',
])

@php
    $id = $id ?? ($name . '_' . \Illuminate\Support\Str::slug($value));
    $isChecked = old($name) !== null ? old($name) == $value : $checked;

    $accentHex = match($color) {
        'blue', 'sky', 'indigo' => '#2563eb',
        'purple', 'violet' => '#9333ea',
        'rose', 'danger', 'red' => '#e11d48',
        'amber', 'warning', 'yellow' => '#f59e0b',
        'dark', 'zinc' => '#18181b',
        default => '#059669',
    };

    $accentClass = match($color) {
        'blue', 'sky', 'indigo' => 'accent-blue-600 dark:accent-blue-500',
        'purple', 'violet' => 'accent-purple-600 dark:accent-purple-500',
        'rose', 'danger', 'red' => 'accent-rose-600 dark:accent-rose-500',
        'amber', 'warning', 'yellow' => 'accent-amber-500 dark:accent-amber-400',
        'dark', 'zinc' => 'accent-zinc-900 dark:accent-zinc-100',
        default => 'accent-emerald-600 dark:accent-emerald-500',
    };
@endphp

@if ($variant === 'card')
    <label for="{{ $id }}"
        class="relative flex {{ $description ? 'items-start' : 'items-center' }} gap-3.5 p-3.5 rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30 hover:bg-white dark:hover:bg-zinc-800/70 hover:border-emerald-500/50 dark:hover:border-emerald-500/50 transition-all duration-200 select-none group {{ $disabled ? 'opacity-60 cursor-not-allowed' : 'cursor-pointer' }} {{ $class }}">
        <div class="flex items-center shrink-0 {{ $description ? 'mt-0.5' : '' }}">
            <input type="radio"
                name="{{ $name }}"
                id="{{ $id }}"
                value="{{ $value }}"
                style="accent-color: {{ $accentHex }};"
                {{ $isChecked ? 'checked' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => "w-4 h-4 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 {$accentClass} focus:ring-2 focus:ring-emerald-500/30 focus:ring-offset-0 focus:outline-none transition cursor-pointer disabled:cursor-not-allowed"]) }}>
        </div>
        <div class="text-xs flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2">
                <span class="font-bold text-zinc-900 dark:text-zinc-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                    {{ $label ?? $slot }}
                </span>
                @if ($badge)
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60">
                        {{ $badge }}
                    </span>
                @endif
            </div>
            @if ($description)
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    {{ $description }}
                </p>
            @endif
        </div>
    </label>
@else
    <label for="{{ $id }}"
        class="relative inline-flex {{ $description ? 'items-start' : 'items-center' }} gap-2.5 select-none group {{ $disabled ? 'opacity-60 cursor-not-allowed' : 'cursor-pointer' }} {{ $class }}">
        <div class="flex items-center shrink-0 {{ $description ? 'mt-0.5' : '' }}">
            <input type="radio"
                name="{{ $name }}"
                id="{{ $id }}"
                value="{{ $value }}"
                style="accent-color: {{ $accentHex }};"
                {{ $isChecked ? 'checked' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->merge(['class' => "w-4 h-4 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 {$accentClass} focus:ring-2 focus:ring-emerald-500/30 focus:ring-offset-0 focus:outline-none transition cursor-pointer disabled:cursor-not-allowed"]) }}>
        </div>
        <div class="text-xs flex-1">
            <span class="font-semibold text-zinc-800 dark:text-zinc-200 group-hover:text-zinc-900 dark:group-hover:text-white transition-colors leading-none">
                {{ $label ?? $slot }}
            </span>
            @if ($description)
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5 leading-relaxed">
                    {{ $description }}
                </p>
            @endif
        </div>
    </label>
@endif
