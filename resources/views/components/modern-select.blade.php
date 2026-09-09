@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'options' => [],
    'multiple' => false,
    'required' => false,
    'tooltip' => null,
    'corner' => null,
    'hint' => null,
])

@php
    $id = $id ?? $name;
    $baseClasses = 'block w-full rounded-xl border border-zinc-200/80 dark:border-zinc-700/80 bg-zinc-50 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-2xs focus:bg-white dark:focus:bg-zinc-800 focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 py-3 appearance-none transition-all duration-200 cursor-pointer pr-10 text-sm ' . (isset($iconSlot) ? 'pl-11' : 'px-4');
@endphp

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
        @if (isset($iconSlot))
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                {{ $iconSlot }}
            </div>
        @endif
        <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $name }}"
            {{ $multiple ? 'multiple' : '' }}
            {{ $attributes->merge(['class' => $baseClasses]) }}>
            @if (!$multiple)
                <option value="">Select {{ $label }}</option>
            @endif
            @foreach ($options as $key => $optionLabel)
                <option value="{{ $key }}"
                    {{ (is_array(old($name, $value)) ? in_array($key, old($name, $value)) : old($name, $value) == $key) ? 'selected' : '' }} class="bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100">
                    {{ $optionLabel }}
                </option>
            @endforeach
            {{ $slot }}
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none text-zinc-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
