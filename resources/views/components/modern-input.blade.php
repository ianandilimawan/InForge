@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'icon' => null,
    'required' => false,
    'hint' => null,
    'tooltip' => null,
    'corner' => null,
    'align' => null,
    'isCurrency' => false,
    'clearable' => false,
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
    $hasIcon = isset($iconSlot) || !empty($icon);

    $textAlignClass = $align === 'right' ? 'text-right ' : ($align === 'center' ? 'text-center ' : '');

    $baseClasses = 'block w-full rounded-xl text-xs sm:text-sm transition-all duration-200 shadow-2xs ' . $textAlignClass;

    if ($isDisabled) {
        $stateClasses = 'bg-zinc-100 dark:bg-zinc-800/60 border border-zinc-200 dark:border-zinc-700 text-zinc-400 dark:text-zinc-500 cursor-not-allowed';
    } elseif ($hasError) {
        $stateClasses = 'bg-rose-50/40 dark:bg-rose-950/20 border border-rose-400 dark:border-rose-600 text-rose-900 dark:text-rose-100 focus:bg-white dark:focus:bg-zinc-800 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20';
    } elseif ($isSuccess) {
        $stateClasses = 'bg-emerald-50/40 dark:bg-emerald-950/20 border border-emerald-400 dark:border-emerald-600 text-emerald-900 dark:text-emerald-100 focus:bg-white dark:focus:bg-zinc-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20';
    } else {
        $stateClasses = 'bg-zinc-50 dark:bg-zinc-800/80 border border-zinc-200/80 dark:border-zinc-700/80 text-zinc-900 dark:text-white focus:bg-white dark:focus:bg-zinc-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20';
    }

    $leftPadding = $hasIcon ? 'pl-9' : 'pl-3.5';
    $rightPadding = ($clearable || $hasError || $isSuccess) ? 'pr-9' : 'pr-3.5';
    $paddingClasses = "py-2.5 {$leftPadding} {$rightPadding}";

    $mergedClasses = "{$baseClasses} {$stateClasses} {$paddingClasses}";
@endphp

@if ($isCurrency)
    @once
        @push('scripts')
            @vite('resources/js/form-libs.js')
        @endpush
    @endonce
@endif

<div class="{{ $class }}"
    @if ($clearable || $counter)
        x-data="{
            val: @js(old($name, $value) ?? ''),
            clear() {
                this.val = '';
                if ($refs.input) {
                    $refs.input.value = '';
                    $refs.input.focus();
                    $refs.input.dispatchEvent(new Event('input'));
                }
            }
        }"
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

    <div class="relative">
        @if (isset($iconSlot))
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                {{ $iconSlot }}
            </div>
        @elseif ($icon)
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                @if ($icon === 'currency' || $icon === 'cash' || $icon === 'money')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                @elseif ($icon === 'search')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                @elseif ($icon === 'email' || $icon === 'mail')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                @elseif ($icon === 'user')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                @elseif ($icon === 'lock')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                @elseif ($icon === 'phone')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                @endif
            </div>
        @endif

        <input
            @if ($clearable || $counter)
                x-ref="input"
                x-model="val"
            @endif
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ old($name, $value) }}"
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($required) required @endif
            @if ($isDisabled) disabled @endif
            @if ($maxlength) maxlength="{{ $maxlength }}" @endif
            {!! $isCurrency ? 'data-currency="true"' : '' !!}
            {{ $attributes->merge(['class' => $mergedClasses]) }}
        />

        @if ($clearable)
            <button
                x-show="val && val.length > 0"
                x-cloak
                @click="clear"
                type="button"
                tabindex="-1"
                aria-label="Clear text"
                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 rounded-lg text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 transition-colors focus:outline-none cursor-pointer"
            >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @elseif ($isSuccess)
            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-emerald-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        @elseif ($hasError)
            <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-rose-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        @endif
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
