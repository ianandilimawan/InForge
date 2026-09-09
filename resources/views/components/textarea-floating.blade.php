@props(['name', 'label', 'value' => '', 'required' => false, 'id' => null, 'rows' => 3])

@php
    $id = $id ?? $name;
    $isReadonly = $attributes->has('readonly') || $attributes->has('disabled');
    $baseClasses =
        'block px-4 pt-5 pb-3 w-full text-sm text-zinc-900 rounded-xl border appearance-none dark:text-white peer transition-colors';
    $activeClasses =
        'bg-transparent border-zinc-300 dark:border-zinc-700 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600';
    $readonlyClasses =
        'bg-zinc-100 border-zinc-300 dark:bg-zinc-800/60 dark:border-zinc-700 text-zinc-500 cursor-not-allowed';
    $mergedClasses = $baseClasses . ' ' . ($isReadonly ? $readonlyClasses : $activeClasses);

    $labelBaseClasses =
        'pointer-events-none absolute text-sm text-zinc-500 dark:text-zinc-400 duration-200 transform -translate-y-3.5 scale-75 top-2 z-10 origin-[0] px-1.5 start-2.5';
    $labelActiveClasses =
        'bg-white dark:bg-zinc-900 peer-focus:px-1.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:top-4 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-3.5 cursor-text';
    $labelReadonlyClasses =
        'bg-zinc-100 dark:bg-zinc-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:top-4 cursor-not-allowed';
    $mergedLabelClasses = $labelBaseClasses . ' ' . ($isReadonly ? $labelReadonlyClasses : $labelActiveClasses);
@endphp

<div class="relative">
    <textarea name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" {{ $required ? 'required' : '' }}
        placeholder=" " {{ $isReadonly ? 'readonly' : '' }} {{ $attributes->merge(['class' => $mergedClasses]) }}>{{ old($name, $value) }}</textarea>
    <label for="{{ $id }}" class="{{ $mergedLabelClasses }}">
        {{ $label }}
        @if ($required)
            <span class="text-rose-500 font-bold">*</span>
        @endif
    </label>
    @if (isset($errors) && $errors->has($name))
        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $errors->first($name) }}</p>
    @endif
</div>
