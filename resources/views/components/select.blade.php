@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'options' => [],
    'multiple' => false,
    'searchable' => false,
    'placeholder' => null,
    'required' => false,
    'tooltip' => null,
    'corner' => null,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
])

@php
    $id = $id ?? $name;
    $selectedValues = old($name, $value);
    if (!is_array($selectedValues)) {
        $selectedValues = $selectedValues !== null && $selectedValues !== '' ? [$selectedValues] : [];
    }
    $placeholderText = $placeholder ?? ($label ? 'Select ' . $label : 'Select Option');
    $isDisabled = $disabled || $readonly || $attributes->has('disabled') || $attributes->has('readonly');

    $baseClasses = 'block w-full rounded-xl border border-zinc-200/80 dark:border-zinc-700/80 bg-zinc-50 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-2xs focus:bg-white dark:focus:bg-zinc-800 focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 text-sm ' .
        ($multiple ? 'py-2 px-3 min-h-[135px]' : 'py-3 px-4 appearance-none cursor-pointer pr-10 ') .
        ($isDisabled ? 'opacity-60 cursor-not-allowed bg-zinc-100 dark:bg-zinc-800/50 ' : '') .
        ($searchable ? 'select2' : '');
@endphp

@if ($searchable)
    @once
        @push('scripts')
            @vite('resources/js/form-libs.js')
        @endpush
    @endonce
@endif

<div>
    @if ($label || $corner || $tooltip)
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-1.5">
                @if ($label)
                    <label for="{{ $id }}"
                        class="block text-xs uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400">
                        {{ $label }}
                    </label>
                @endif
                @if ($required)
                    <span class="text-rose-500 font-bold text-xs" title="Required">*</span>
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
        <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $id }}"
            {{ $multiple ? 'multiple' : '' }}
            {{ $isDisabled ? 'disabled' : '' }}
            {!! $searchable ? 'data-searchable="true"' : '' !!}
            data-placeholder="{{ $placeholderText }}"
            {{ $attributes->merge(['class' => $baseClasses]) }}>
            @if (!$multiple)
                <option value="">{{ $placeholderText }}</option>
            @endif
            @foreach ($options as $key => $optionLabel)
                <option value="{{ $key }}"
                    {{ in_array((string) $key, array_map('strval', $selectedValues)) ? 'selected' : '' }}
                    class="bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 py-1">
                    {{ $optionLabel }}
                </option>
            @endforeach
            {{ $slot }}
        </select>
        @unless ($searchable || $multiple)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-zinc-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        @endunless
    </div>
    @if ($hint)
        <p class="mt-1 text-xs text-zinc-400 dark:text-zinc-500">{{ $hint }}</p>
    @elseif ($multiple)
        <p class="mt-1 text-[11px] text-zinc-400 dark:text-zinc-500">Hold <kbd class="px-1 py-0.5 rounded bg-zinc-200 dark:bg-zinc-700 text-[10px] font-mono font-semibold">Ctrl</kbd> / <kbd class="px-1 py-0.5 rounded bg-zinc-200 dark:bg-zinc-700 text-[10px] font-mono font-semibold">⌘ Cmd</kbd> to select multiple items.</p>
    @endif
    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
