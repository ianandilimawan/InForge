@props([
    'name' => null,
    'label' => null,
    'description' => null,
    'hint' => null,
    'required' => false,
    'inline' => false,
    'badge' => null,
    'class' => '',
    'labelClass' => '',
    'controlClass' => '',
])

@php
    $subtext = $description ?? $hint;
@endphp

@if ($inline)
    <div class="sm:grid sm:grid-cols-3 sm:gap-6 sm:items-start pt-4 first:pt-0 pb-4 last:pb-0 border-b last:border-b-0 border-zinc-100 dark:border-zinc-800/80 {{ $class }}">
        <div class="sm:col-span-1 mb-2 sm:mb-0 {{ $labelClass }}">
            @if ($label)
                <div class="flex items-center gap-2">
                    <label @if($name) for="{{ $name }}" @endif class="block text-xs uppercase tracking-wider font-bold text-zinc-700 dark:text-zinc-300">
                        {{ $label }}
                        @if ($required)
                            <span class="text-rose-500 font-bold ml-0.5">*</span>
                        @endif
                    </label>
                    @if ($badge)
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60">
                            {{ $badge }}
                        </span>
                    @endif
                </div>
            @endif
            @if ($subtext)
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    {{ $subtext }}
                </p>
            @endif
        </div>
        <div class="sm:col-span-2 space-y-1.5 {{ $controlClass }}">
            {{ $slot }}
            @if ($name)
                @error($name)
                    <p class="text-xs text-rose-600 dark:text-rose-400 font-medium">
                        {{ $message }}
                    </p>
                @enderror
            @endif
        </div>
    </div>
@else
    <div class="space-y-1.5 {{ $class }}">
        @if ($label)
            <div class="flex items-center justify-between gap-2 {{ $labelClass }}">
                <label @if($name) for="{{ $name }}" @endif class="block text-xs uppercase tracking-wider font-bold text-zinc-600 dark:text-zinc-400">
                    {{ $label }}
                    @if ($required)
                        <span class="text-rose-500 font-bold ml-0.5">*</span>
                    @endif
                </label>
                @if ($badge)
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60">
                        {{ $badge }}
                    </span>
                @endif
            </div>
        @endif

        <div class="{{ $controlClass }}">
            {{ $slot }}
        </div>

        @if ($subtext)
            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 leading-relaxed">
                {{ $subtext }}
            </p>
        @endif

        @if ($name)
            @error($name)
                <p class="text-xs text-rose-600 dark:text-rose-400 font-medium">
                    {{ $message }}
                </p>
            @enderror
        @endif
    </div>
@endif
