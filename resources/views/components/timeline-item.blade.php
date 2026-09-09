@props([
    'title',
    'time' => null,
    'description' => null,
    'icon' => null,
    'color' => 'primary', // 'primary', 'blue', 'purple', 'rose', 'amber'
    'badge' => null,
    'class' => '',
])

@php
    $nodeColor = match($color) {
        'blue', 'sky' => 'bg-blue-500 text-white ring-blue-100 dark:ring-blue-950/60',
        'purple', 'violet' => 'bg-purple-500 text-white ring-purple-100 dark:ring-purple-950/60',
        'rose', 'danger', 'red' => 'bg-rose-500 text-white ring-rose-100 dark:ring-rose-950/60',
        'amber', 'warning', 'yellow' => 'bg-amber-500 text-white ring-amber-100 dark:ring-amber-950/60',
        default => 'bg-emerald-500 text-white ring-emerald-100 dark:ring-emerald-950/60',
    };
@endphp

<div class="relative group {{ $class }}">
    {{-- Node Icon / Dot --}}
    <div class="absolute -left-[30px] top-0.5 w-5 h-5 rounded-full ring-4 {{ $nodeColor }} flex items-center justify-center text-[10px] shadow-sm shrink-0 select-none">
        @if ($icon)
            <span class="w-3 h-3 flex items-center justify-center">{!! $icon !!}</span>
        @else
            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
        @endif
    </div>

    {{-- Content --}}
    <div class="space-y-1">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="text-xs sm:text-sm font-bold text-zinc-900 dark:text-white">
                    {{ $title }}
                </span>
                @if ($badge)
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300">
                        {{ $badge }}
                    </span>
                @endif
            </div>

            @if ($time)
                <span class="text-[11px] font-medium text-zinc-400 dark:text-zinc-500 shrink-0">
                    {{ $time }}
                </span>
            @endif
        </div>

        @if ($description)
            <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
                {{ $description }}
            </p>
        @endif

        @if ($slot->isNotEmpty())
            <div class="mt-2 text-xs">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>
