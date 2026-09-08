@props(['name', 'label' => null, 'value' => null, 'options' => [], 'multiple' => false])

@php
    $baseClasses = 'block w-full rounded-xl border border-zinc-200/80 dark:border-zinc-700/80 bg-zinc-50 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-2xs focus:bg-white dark:focus:bg-zinc-800 focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 py-3 px-4 appearance-none transition-all duration-200 cursor-pointer pr-10 text-sm';
@endphp

<div>
    @if ($label)
        <label for="{{ $name }}"
            class="block text-xs uppercase tracking-wider font-bold text-zinc-500 dark:text-zinc-400 mb-2">{{ $label }}</label>
    @endif
    <div class="relative">
        <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" id="{{ $name }}"
            {{ $multiple ? 'multiple' : '' }} {{ $attributes->merge(['class' => $baseClasses]) }}>
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
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
