@props([
    'class' => '',
])

<div {{ $attributes->merge(['class' => "divide-y divide-zinc-200/80 dark:divide-zinc-800 border border-zinc-200/80 dark:border-zinc-800 rounded-2xl bg-white dark:bg-zinc-900 shadow-sm overflow-hidden {$class}"]) }}>
    {{ $slot }}
</div>
