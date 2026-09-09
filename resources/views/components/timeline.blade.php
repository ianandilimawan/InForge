@props([
    'class' => '',
])

<div {{ $attributes->merge(['class' => "relative pl-6 space-y-6 before:absolute before:left-2.5 before:top-2.5 before:bottom-2.5 before:w-0.5 before:bg-zinc-200 dark:before:bg-zinc-800 {$class}"]) }}>
    {{ $slot }}
</div>
