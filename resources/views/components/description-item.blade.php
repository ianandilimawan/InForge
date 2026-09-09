@props([
    'label',
    'value' => null,
    'class' => '',
])

<div class="px-5 py-3.5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center text-xs sm:text-sm {{ $class }}">
    <dt class="font-bold text-zinc-500 dark:text-zinc-400">
        {{ $label }}
    </dt>
    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-zinc-800 dark:text-zinc-200">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            {{ $value }}
        @endif
    </dd>
</div>
