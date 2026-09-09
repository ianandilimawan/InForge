@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => '',
    'placeholder' => '••••••••',
    'strength' => false,
    'required' => false,
    'class' => '',
])

@php
    $id = $id ?? $name;
    $isReadonly = $attributes->has('readonly') || $attributes->has('disabled');
    $baseClasses = 'block w-full rounded-xl border border-transparent text-gray-900 dark:text-white shadow-sm py-3.5 pl-4 pr-11 transition-all duration-200';
    $activeClasses = 'bg-gray-50 dark:bg-gray-800/80 focus:bg-white dark:focus:bg-gray-800 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500';
    $readonlyClasses = 'bg-gray-200/60 dark:bg-gray-900/60 opacity-75 cursor-not-allowed';
    $mergedClasses = $baseClasses . ' ' . ($isReadonly ? $readonlyClasses : $activeClasses);
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
    @if ($label)
        <label for="{{ $id }}" class="block text-xs uppercase tracking-wider font-bold text-gray-500 dark:text-gray-400 mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-rose-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input :type="show ? 'text' : 'password'"
            name="{{ $name }}"
            id="{{ $id }}"
            x-model="password"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => $mergedClasses]) }}>

        @unless($isReadonly)
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
                <svg x-show="show" x-cloak class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
