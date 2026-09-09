@props([
    'type' => 'text', // 'text', 'avatar', 'button', 'card', 'table-row'
    'lines' => 1,
    'size' => 'md',
    'class' => '',
])

@php
    $baseClasses = 'animate-pulse bg-zinc-200/80 dark:bg-zinc-800 rounded-md';
@endphp

@if ($type === 'avatar')
    @php
        $avatarSize = match($size) {
            'xs' => 'w-6 h-6',
            'sm' => 'w-8 h-8',
            'lg' => 'w-12 h-12',
            'xl' => 'w-14 h-14',
            default => 'w-10 h-10',
        };
    @endphp
    <div class="{{ $baseClasses }} {{ $avatarSize }} rounded-full shrink-0 {{ $class }}"></div>

@elseif ($type === 'button')
    <div class="{{ $baseClasses }} h-9 w-24 rounded-xl {{ $class }}"></div>

@elseif ($type === 'card')
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 rounded-2xl p-5 space-y-4 shadow-sm animate-pulse {{ $class }}">
        <div class="flex items-center justify-between gap-4">
            <div class="space-y-2 flex-1">
                <div class="h-3 bg-zinc-200 dark:bg-zinc-800 rounded-md w-28"></div>
                <div class="h-6 bg-zinc-200 dark:bg-zinc-800 rounded-md w-40"></div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-zinc-200 dark:bg-zinc-800 shrink-0"></div>
        </div>
        <div class="h-2 bg-zinc-100 dark:bg-zinc-800/60 rounded-md w-full"></div>
    </div>

@elseif ($type === 'table-row')
    <tr class="animate-pulse">
        <td class="p-4"><div class="h-4 w-4 bg-zinc-200 dark:bg-zinc-800 rounded"></div></td>
        <td class="p-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-zinc-200 dark:bg-zinc-800 rounded-full shrink-0"></div>
                <div class="space-y-1.5">
                    <div class="h-3.5 bg-zinc-200 dark:bg-zinc-800 rounded w-28"></div>
                    <div class="h-2.5 bg-zinc-200 dark:bg-zinc-800 rounded w-36"></div>
                </div>
            </div>
        </td>
        <td class="p-4"><div class="h-3.5 bg-zinc-200 dark:bg-zinc-800 rounded w-20"></div></td>
        <td class="p-4"><div class="h-5 bg-zinc-200 dark:bg-zinc-800 rounded-full w-16"></div></td>
        <td class="p-4 text-right"><div class="h-7 bg-zinc-200 dark:bg-zinc-800 rounded-lg w-14 ml-auto"></div></td>
    </tr>

@else
    {{-- Paragraph / Text Lines --}}
    <div class="space-y-2 {{ $class }}">
        @for ($i = 0; $i < $lines; $i++)
            @php
                $width = ($i === $lines - 1 && $lines > 1) ? 'w-3/5' : 'w-full';
            @endphp
            <div class="{{ $baseClasses }} h-3.5 {{ $width }}"></div>
        @endfor
    </div>
@endif
