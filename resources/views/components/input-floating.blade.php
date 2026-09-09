@props([
    'type' => 'text',
    'name',
    'id' => null,
    'label',
    'value' => '',
    'required' => false,
    'hint' => null,
    'align' => null,
    'isCurrency' => false,
    'class' => '',
    'readonly' => false,
    'showError' => true,
])

@php
    $id = $id ?? $name;
    $isReadonly = $readonly || $attributes->has('readonly') || $attributes->has('disabled');
    $textAlign = $align === 'right' ? 'text-right ' : ($align === 'center' ? 'text-center ' : '');
    $baseClasses =
        'block h-[50px] px-4 pt-4 pb-1.5 w-full text-sm text-zinc-900 rounded-xl border appearance-none dark:text-white peer transition-colors ' . $textAlign;
    $activeClasses =
        'bg-transparent border-zinc-300 dark:border-zinc-700 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600';
    $readonlyClasses =
        'bg-zinc-100 border-zinc-300 dark:bg-zinc-800/60 dark:border-zinc-700 text-zinc-500 cursor-not-allowed';
    $mergedClasses = $baseClasses . ' ' . ($isReadonly ? $readonlyClasses : $activeClasses);

    $labelBaseClasses =
        'pointer-events-none absolute text-sm text-zinc-500 dark:text-zinc-400 duration-200 transform -translate-y-3.5 scale-75 top-2 z-10 origin-[0] px-1.5 start-2.5';
    $labelActiveClasses =
        'bg-white dark:bg-zinc-900 peer-focus:px-1.5 peer-focus:text-blue-600 peer-focus:dark:text-blue-400 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-3.5 cursor-text';
    $labelReadonlyClasses =
        'bg-zinc-100 dark:bg-zinc-800 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 cursor-not-allowed';
    $mergedLabelClasses = $labelBaseClasses . ' ' . ($isReadonly ? $labelReadonlyClasses : $labelActiveClasses);
@endphp

@if ($isCurrency)
    @once
        @push('scripts')
            @vite('resources/js/form-libs.js')
        @endpush
    @endonce
@endif

<div class="relative {{ $class }}">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
        {{ $required ? 'required' : '' }} placeholder=" " {{ $isCurrency ? 'data-currency' : '' }}
        {{ $isReadonly ? 'readonly' : '' }} {{ $attributes->merge(['class' => $mergedClasses]) }} />
    <label for="{{ $id }}" class="{{ $mergedLabelClasses }}">
        {{ $label }}
        @if ($required)
            <span class="text-rose-500 font-bold">*</span>
        @endif
    </label>
    @if ($showError && isset($errors) && $errors->has($name))
        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $errors->first($name) }}</p>
    @endif
    @if ($hint && !(isset($errors) && $errors->has($name)))
        <p class="mt-1.5 text-xs text-zinc-500 dark:text-zinc-400">{{ $hint }}</p>
    @endif
</div>
