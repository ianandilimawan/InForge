@props([
    'name' => null,
    'value' => 0,
    'max' => 5,
    'size' => 'md',
    'readonly' => false,
    'showValue' => false,
    'color' => 'amber',
    'class' => '',
])

@php
    $sizeClasses = [
        'sm' => 'w-3.5 h-3.5',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
    ][$size] ?? 'w-5 h-5';

    $activeColors = [
        'amber' => 'text-amber-400 dark:text-amber-400',
        'yellow' => 'text-yellow-400 dark:text-yellow-400',
        'blue' => 'text-blue-500 dark:text-blue-400',
        'rose' => 'text-rose-500 dark:text-rose-400',
    ][$color] ?? 'text-amber-400 dark:text-amber-400';

    $inactiveColor = 'text-zinc-300 dark:text-zinc-700';
@endphp

<div
    x-data="{
        current: {{ (float) $value }},
        hover: 0,
        readonly: {{ $readonly ? 'true' : 'false' }},
        setRating(val) {
            if (this.readonly) return;
            this.current = val;
            this.$dispatch('rating-changed', val);
        }
    }"
    {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 {$class}"]) }}
>
    @if ($name && !$readonly)
        <input type="hidden" name="{{ $name }}" :value="current" />
    @endif

    <div class="inline-flex items-center gap-0.5" @mouseleave="hover = 0">
        @for ($i = 1; $i <= $max; $i++)
            <button
                type="button"
                :disabled="readonly"
                @mouseenter="if (!readonly) hover = {{ $i }}"
                @click="setRating({{ $i }})"
                class="{{ $readonly ? 'cursor-default' : 'cursor-pointer hover:scale-110 active:scale-95' }} p-0.5 rounded transition-transform duration-100 focus:outline-none"
                aria-label="Rate {{ $i }} of {{ $max }} stars"
            >
                <svg
                    class="{{ $sizeClasses }} transition-colors duration-150"
                    :class="(hover > 0 ? {{ $i }} <= hover : {{ $i }} <= current) ? '{{ $activeColors }} fill-current' : '{{ $inactiveColor }} fill-current'"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            </button>
        @endfor
    </div>

    @if ($showValue)
        <span class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 ml-1 select-none">
            <span x-text="current">{{ $value }}</span> / {{ $max }}
        </span>
    @endif
</div>
