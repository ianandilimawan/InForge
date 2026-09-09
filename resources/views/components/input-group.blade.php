@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'prefix' => null,
    'suffix' => null,
    'prefixSlot' => null,
    'suffixSlot' => null,
    'buttonSlot' => null,
    'description' => null,
    'hint' => null,
    'disabled' => false,
    'readonly' => false,
    'isCurrency' => false,
    'required' => false,
    'class' => '',
])

@php
    $id = $id ?? $name;
    $isReadonly = $readonly || $attributes->has('readonly');
    $isDisabled = $disabled || $attributes->has('disabled');
    $subtext = $description ?? $hint;
@endphp

@if ($isCurrency)
    @once
        @push('scripts')
            @vite('resources/js/form-libs.js')
        @endpush
    @endonce
@endif

<div class="space-y-1.5 {{ $class }}">
    @if ($label)
        <div class="flex items-center justify-between gap-2">
            <label for="{{ $id }}" class="block text-xs uppercase tracking-wider font-bold text-zinc-600 dark:text-zinc-400">
                {{ $label }}
                @if ($required)
                    <span class="text-rose-500 font-bold ml-0.5">*</span>
                @endif
            </label>
        </div>
    @endif

    <div class="relative flex items-stretch w-full rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-zinc-50/60 dark:bg-zinc-800/50 shadow-sm overflow-hidden transition-all duration-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/20 focus-within:bg-white dark:focus-within:bg-zinc-900 {{ $isDisabled || $isReadonly ? 'opacity-70 bg-zinc-100 dark:bg-zinc-900/60 cursor-not-allowed' : '' }}">
        {{-- Prefix Addon (Text or Slot) --}}
        @if ($prefixSlot)
            <div class="flex items-center shrink-0 border-r border-zinc-200/80 dark:border-zinc-800 bg-zinc-100/80 dark:bg-zinc-800/80 text-zinc-500 dark:text-zinc-400">
                {{ $prefixSlot }}
            </div>
        @elseif ($prefix)
            <span class="inline-flex items-center px-3.5 text-xs font-semibold text-zinc-500 dark:text-zinc-400 bg-zinc-100/80 dark:bg-zinc-800/80 border-r border-zinc-200/80 dark:border-zinc-800 select-none shrink-0">
                {{ $prefix }}
            </span>
        @endif

        {{-- Center Input or Slot Content --}}
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            <input type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $id }}"
                value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder }}"
                {{ $isDisabled ? 'disabled' : '' }}
                {{ $isReadonly ? 'readonly' : '' }}
                {!! $isCurrency ? 'data-currency="true"' : '' !!}
                {{ $attributes->merge(['class' => 'w-full flex-1 min-w-0 bg-transparent border-0 px-3.5 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 dark:text-white placeholder-zinc-400 focus:outline-none focus:ring-0 disabled:cursor-not-allowed disabled:text-zinc-500 dark:disabled:text-zinc-500 transition-colors']) }}>
        @endif

        {{-- Suffix Addon (Text or Slot) --}}
        @if ($suffixSlot)
            <div class="flex items-center shrink-0 border-l border-zinc-200/80 dark:border-zinc-800 bg-zinc-100/80 dark:bg-zinc-800/80 text-zinc-500 dark:text-zinc-400">
                {{ $suffixSlot }}
            </div>
        @elseif ($suffix)
            <span class="inline-flex items-center px-3.5 text-xs font-semibold text-zinc-500 dark:text-zinc-400 bg-zinc-100/80 dark:bg-zinc-800/80 border-l border-zinc-200/80 dark:border-zinc-800 select-none shrink-0">
                {{ $suffix }}
            </span>
        @endif

        {{-- Attached Action Button Slot --}}
        @if ($buttonSlot)
            <div class="flex items-center shrink-0 p-1 bg-zinc-100/50 dark:bg-zinc-800/40 border-l border-zinc-200/80 dark:border-zinc-800">
                {{ $buttonSlot }}
            </div>
        @endif
    </div>

    @if ($subtext)
        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">
            {{ $subtext }}
        </p>
    @endif

    @error($name)
        <p class="text-xs text-rose-600 dark:text-rose-400 font-medium">
            {{ $message }}
        </p>
    @enderror
</div>
