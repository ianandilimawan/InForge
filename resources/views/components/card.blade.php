@props([
    'title' => null,
    'subtitle' => null,
    'actions' => null,
    'header' => null,
    'footer' => null,
    'padding' => 'p-5 sm:p-6',
    'rounded' => 'rounded-2xl',
])

<div {{ $attributes->merge(['class' => "bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 {$rounded} shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden"]) }}>
    @if ($header)
        <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800">
            {{ $header }}
        </div>
    @elseif ($title || $actions)
        <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between gap-4">
            <div>
                @if ($title)
                    <h3 class="text-sm sm:text-base font-bold text-zinc-900 dark:text-white tracking-tight">
                        {{ $title }}
                    </h3>
                @endif
                @if ($subtitle)
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>
            @if ($actions)
                <div class="flex items-center gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $padding }}">
        {{ $slot }}
    </div>

    @if ($footer)
        <div class="px-5 py-3 bg-zinc-50/50 dark:bg-zinc-800/30 border-t border-zinc-100 dark:border-zinc-800">
            {{ $footer }}
        </div>
    @endif
</div>
