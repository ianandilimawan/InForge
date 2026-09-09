@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => '',
    'placeholder' => '••••••••',
    'strength' => false,
    'required' => false,
    'hint' => null,
    'tooltip' => null,
    'corner' => null,
    'state' => null, // 'error' | 'success' | null
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

    $baseClasses = 'block w-full rounded-xl text-xs sm:text-sm transition-all duration-200 shadow-2xs py-2.5 pl-3.5 pr-10 ';

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

<div x-data="{
    show: false,
    password: '{{ old($name, $value) }}',
    get score() {
        const p = this.password || '';
        if (p.length === 0) return 0;
        let s = 0;
        if (p.length >= 8) s++;
        if (/[a-z]/.test(p) && /[A-Z]/.test(p)) s++;
        if (/[0-9]/.test(p)) s++;
        if (/[^A-Za-z0-9]/.test(p)) s++;
        return Math.min(4, Math.max(1, s));
    },
    get label() {
        return ['', 'Very Weak', 'Weak', 'Fair', 'Strong'][this.score] || '';
    },
    get barColor() {
        return [
            'bg-zinc-200 dark:bg-zinc-700',
            'bg-rose-500',
            'bg-orange-500',
            'bg-amber-500',
            'bg-emerald-500'
        ][this.score] || 'bg-zinc-200 dark:bg-zinc-700';
    },
    get textColor() {
        return [
            'text-zinc-400',
            'text-rose-500 dark:text-rose-400',
            'text-orange-500 dark:text-orange-400',
            'text-amber-500 dark:text-amber-400',
            'text-emerald-500 dark:text-emerald-400'
        ][this.score] || 'text-zinc-400';
    }
}" class="{{ $class }}">
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
                <div>{{ $corner }}</div>
            @endif
        </div>
    @endif

    <div class="relative">
        <input :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            id="{{ $id }}"
            x-model="password"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $isDisabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => $mergedClasses]) }}>

        @unless($isDisabled)
            <button type="button"
                @click="show = !show"
                tabindex="-1"
                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 transition-colors focus:outline-none p-1 rounded-md"
                aria-label="Toggle password visibility">
                <!-- Eye Icon (Hidden State) -->
                <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <!-- Eye Slash Icon (Visible State) -->
                <svg x-show="show" x-cloak class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </button>
        @endunless
    </div>

    @if ($strength)
        <div x-show="password && password.length > 0" x-transition.opacity class="mt-2.5 space-y-1.5">
            <div class="grid grid-cols-4 gap-1.5">
                <div class="h-1.5 rounded-full transition-all duration-300"
                    :class="score >= 1 ? barColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                <div class="h-1.5 rounded-full transition-all duration-300"
                    :class="score >= 2 ? barColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                <div class="h-1.5 rounded-full transition-all duration-300"
                    :class="score >= 3 ? barColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
                <div class="h-1.5 rounded-full transition-all duration-300"
                    :class="score >= 4 ? barColor : 'bg-zinc-200 dark:bg-zinc-700'"></div>
            </div>
            <div class="flex items-center justify-between text-[11px] px-0.5">
                <span class="text-zinc-500 dark:text-zinc-400 font-medium">Password strength:</span>
                <span class="font-bold transition-colors duration-200" :class="textColor" x-text="label"></span>
            </div>
        </div>
    @endif

    @if ($hint && !$hasError)
        <p class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400">{{ $hint }}</p>
    @endif

    @if ($hasError)
        <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">
            {{ $errorMessage ?? $errors->first($name) }}
        </p>
    @endif
</div>
