@props([
    'name',
    'id' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
    'disabled' => false,
    'variant' => 'default', // 'default' or 'card'
    'class' => '',
])

@php
    $id = $id ?? $name;
    $isChecked = old($name) !== null ? old($name) == '1' || old($name) === true : $checked;
@endphp

@if ($variant === 'card')
    <div class="relative flex items-center justify-between gap-4 p-3.5 rounded-xl border border-zinc-200/80 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30 hover:bg-white dark:hover:bg-zinc-800/70 hover:border-emerald-500/50 dark:hover:border-emerald-500/50 transition-all duration-200 {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }} {{ $class }}">
        <div class="text-xs flex-1 min-w-0">
            @if ($label)
                <label for="{{ $id }}" class="font-bold text-zinc-900 dark:text-zinc-100 {{ $disabled ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                    {{ $label }}
                </label>
            @endif
            @if ($description)
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5 leading-relaxed">
                    {{ $description }}
                </p>
            @endif
        </div>
        <div class="flex items-center shrink-0">
            <input type="hidden" name="{{ $name }}" value="0">
            <label for="{{ $id }}" class="relative inline-flex items-center {{ $disabled ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                <input type="checkbox"
                    name="{{ $name }}"
                    id="{{ $id }}"
                    value="1"
                    class="sr-only peer"
                    {{ $isChecked ? 'checked' : '' }}
                    {{ $disabled ? 'disabled' : '' }}
                    {{ $attributes }}>
                <div class="w-10 h-6 bg-zinc-200 dark:bg-zinc-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:shadow-sm after:transition-all peer-checked:bg-emerald-600 dark:peer-checked:bg-emerald-500 transition-colors"></div>
            </label>
        </div>
    </div>
@else
    <div class="{{ $class }}">
        <div class="flex items-start gap-3">
            <div class="flex items-center h-5 mt-0.5 shrink-0">
                <input type="hidden" name="{{ $name }}" value="0">
                <label for="{{ $id }}" class="relative inline-flex items-center {{ $disabled ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                    <input type="checkbox"
                        name="{{ $name }}"
                        id="{{ $id }}"
                        value="1"
                        class="sr-only peer"
                        {{ $isChecked ? 'checked' : '' }}
                        {{ $disabled ? 'disabled' : '' }}
                        {{ $attributes }}>
                    <div class="w-9 h-5 bg-zinc-200 dark:bg-zinc-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/30 rounded-full peer peer-checked:after:translate-x-4 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:shadow-sm after:transition-all peer-checked:bg-emerald-600 dark:peer-checked:bg-emerald-500 transition-colors"></div>
                </label>
            </div>
            @if ($label || $description)
                <div class="text-xs">
                    @if ($label)
                        <label for="{{ $id }}" class="font-semibold text-zinc-800 dark:text-zinc-200 select-none {{ $disabled ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                            {{ $label }}
                        </label>
                    @endif
                    @if ($description)
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5 leading-relaxed">
                            {{ $description }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        @error($name)
            <p class="mt-1 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
@endif
