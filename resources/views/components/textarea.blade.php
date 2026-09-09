@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'rows' => 3,
    'required' => false,
    'hint' => null,
    'tooltip' => null,
    'corner' => null,
    'maxlength' => null,
    'counter' => false,
    'state' => null,
    'errorMessage' => null,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
])

@php
    $id = $id ?? $name;
    $isDisabled = $disabled || $readonly || $attributes->has('readonly') || $attributes->has('disabled');
    $hasError = $state === 'error' || (isset($errors) && $errors->has($name)) || !empty($errorMessage);
    $isSuccess = $state === 'success' && !$hasError;

    $baseClasses = 'block w-full rounded-xl text-xs sm:text-sm transition-all duration-200 shadow-2xs py-2.5 px-3.5 ';

    if ($isDisabled) {
        $stateClasses = 'bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-zinc-400 dark:text-zinc-500 cursor-not-allowed';
    } elseif ($hasError) {
        $stateClasses = 'bg-rose-50/40 dark:bg-rose-950/20 border border-rose-400 dark:border-rose-600 text-rose-900 dark:text-rose-100 focus:bg-white dark:focus:bg-zinc-800 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20';
    } elseif ($isSuccess) {
        $stateClasses = 'bg-emerald-50/40 dark:bg-emerald-950/20 border border-emerald-400 dark:border-emerald-600 text-emerald-900 dark:text-emerald-100 focus:bg-white dark:focus:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    } else {
        $stateClasses = 'bg-zinc-50 dark:bg-zinc-800/80 border border-zinc-200/80 dark:border-zinc-700/80 text-zinc-900 dark:text-white focus:bg-white dark:focus:bg-zinc-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20';
    }

    $mergedClasses = "{$baseClasses} {$stateClasses}";
@endphp

<div class="{{ $class }}"
    @if ($counter && $maxlength)
        x-data="{ val: @js(old($name, $value) ?? '') }"
    @endif
>
    @if ($label || $corner || $tooltip)
        <div class="flex items-center justify-between mb-1.5">
            <div class="flex items-center gap-1.5">
                @if ($label)
                    <label for="{{ $id }}" class="block text-[11px] uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400">
                        {{ $label }}
                    </label>
                @endif
                @if ($required)
                    <span class="text-rose-500 font-bold text-[11px]" title="Required">*</span>
                @endif
                @if ($tooltip)
                    <x-tooltip :text="$tooltip" position="top">
                        <button type="button" tabindex="-1" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors focus:outline-none cursor-help">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </x-tooltip>
                @endif
            </div>

            @if ($corner)
                <span class="text-[11px] font-medium text-zinc-400 dark:text-zinc-500">{{ $corner }}</span>
            @endif
        </div>
    @endif

    <div>
        <textarea
            @if ($counter && $maxlength)
                x-model="val"
            @endif
            name="{{ $name }}"
            id="{{ $id }}"
            rows="{{ $rows }}"
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($required) required @endif
            @if ($isDisabled) disabled @endif
            @if ($maxlength) maxlength="{{ $maxlength }}" @endif
            {{ $attributes->merge(['class' => $mergedClasses]) }}>{{ old($name, $value) }}</textarea>
    </div>

    @if ($hint || $hasError || ($counter && $maxlength))
        <div class="flex items-start justify-between gap-2 mt-1.5 px-0.5">
            <div class="flex-1">
                @if ($errorMessage)
                    <p class="text-xs text-rose-600 dark:text-rose-400">{{ $errorMessage }}</p>
                @elseif (isset($errors) && $errors->has($name))
                    <p class="text-xs text-rose-600 dark:text-rose-400">{{ $errors->first($name) }}</p>
                @elseif ($hint)
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $hint }}</p>
                @endif
            </div>

            @if ($counter && $maxlength)
                <span class="text-[11px] font-mono text-zinc-400 dark:text-zinc-500 shrink-0 select-none">
                    <span x-text="(val || '').length">{{ strlen((string) old($name, $value)) }}</span> / {{ $maxlength }}
                </span>
            @endif
        </div>
    @endif
</div>
