@props([
    'striped' => false,
    'class' => '',
])

<div {{ $attributes->merge(['class' => "border border-zinc-200/80 dark:border-zinc-800 rounded-2xl bg-white dark:bg-zinc-900 overflow-hidden shadow-sm divide-y divide-zinc-100 dark:divide-zinc-800/80 " . ($striped ? '[&>div:nth-child(even)]:bg-zinc-50/50 dark:[&>div:nth-child(even)]:bg-zinc-800/20' : '') . " {$class}"]) }}>
    <dl class="divide-y divide-zinc-100 dark:divide-zinc-800/80">
        {{ $slot }}
    </dl>
</div>
