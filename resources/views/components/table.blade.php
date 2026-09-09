@props([
    'header' => null,
    'footer' => null,
    'striped' => false,
    'hoverable' => true,
    'rounded' => 'rounded-2xl',
    'class' => '',
])

<div {{ $attributes->merge(['class' => "bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 {$rounded} shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden {$class}"]) }}>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs sm:text-sm">
            @if ($header)
                <thead class="bg-zinc-50/80 dark:bg-zinc-800/60 border-b border-zinc-200/80 dark:border-zinc-800 text-[11px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    {{ $header }}
                </thead>
            @endif
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800/80 text-zinc-700 dark:text-zinc-300 {{ $hoverable ? '[&>tr:hover]:bg-zinc-50/80 dark:[&>tr:hover]:bg-zinc-800/50 [&>tr]:transition-colors' : '' }}">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if ($footer)
        <div class="px-5 py-3.5 bg-zinc-50/60 dark:bg-zinc-800/40 border-t border-zinc-200/80 dark:border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-zinc-500 dark:text-zinc-400">
            {{ $footer }}
        </div>
    @endif
</div>
