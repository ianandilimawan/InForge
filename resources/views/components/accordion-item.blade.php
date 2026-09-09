@props([
    'title',
    'icon' => null,
    'badge' => null,
    'open' => false,
    'class' => '',
])

<div x-data="{ expanded: {{ $open ? 'true' : 'false' }} }" class="group {{ $class }}">
    <button type="button"
        @click="expanded = !expanded"
        class="w-full flex items-center justify-between gap-4 p-4 text-left transition-colors hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 cursor-pointer focus:outline-none select-none">
        <div class="flex items-center gap-3 min-w-0">
            @if ($icon)
                <span class="w-4 h-4 shrink-0 text-zinc-400 dark:text-zinc-500 group-hover:text-emerald-600 transition-colors">
                    {!! $icon !!}
                </span>
            @endif
            <span class="text-xs sm:text-sm font-bold text-zinc-900 dark:text-white truncate">
                {{ $title }}
            </span>
            @if ($badge)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200/60 dark:border-zinc-700/60">
                    {{ $badge }}
                </span>
            @endif
        </div>

        {{-- Chevron Indicator --}}
        <svg class="w-4 h-4 text-zinc-400 dark:text-zinc-500 transition-transform duration-200 shrink-0"
            :class="expanded ? 'rotate-180 text-emerald-600 dark:text-emerald-400' : ''"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="expanded"
        x-collapse
        x-transition:enter="transition-all ease-out duration-200"
        x-transition:leave="transition-all ease-in duration-150"
        class="px-4 pb-4 pt-1 text-xs leading-relaxed text-zinc-600 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800/60"
        style="display: none;">
        {{ $slot }}
    </div>
</div>
