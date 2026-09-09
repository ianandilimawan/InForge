@props([
    'title' => 'No data found',
    'description' => null,
    'icon' => 'inbox', // 'inbox', 'search', 'folder', 'document'
    'actionText' => null,
    'actionUrl' => null,
    'actionClick' => null,
    'secondaryActionText' => null,
    'secondaryActionUrl' => null,
    'class' => '',
])

<div {{ $attributes->merge(['class' => "text-center py-12 px-4 rounded-2xl border-2 border-dashed border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-900/30 flex flex-col items-center justify-center {$class}"]) }}>
    {{-- Icon with gradient ring --}}
    <div class="w-14 h-14 rounded-2xl bg-zinc-100 dark:bg-zinc-800 border border-zinc-200/80 dark:border-zinc-700/80 flex items-center justify-center text-zinc-400 dark:text-zinc-500 shadow-sm mb-4">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @elseif ($icon === 'search')
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        @elseif ($icon === 'folder')
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
        @elseif ($icon === 'document')
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        @else
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
        @endif
    </div>

    <h3 class="text-sm sm:text-base font-bold text-zinc-900 dark:text-white">
        {{ $title }}
    </h3>

    @if ($description)
        <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-sm mt-1 mb-5 leading-relaxed">
            {{ $description }}
        </p>
    @else
        <div class="mb-4"></div>
    @endif

    @if ($actionText || $secondaryActionText)
        <div class="flex flex-wrap items-center justify-center gap-2.5">
            @if ($actionText)
                <x-button variant="primary" :solid="true" :href="$actionUrl" :click="$actionClick">
                    {{ $actionText }}
                </x-button>
            @endif
            @if ($secondaryActionText)
                <x-button variant="secondary" :href="$secondaryActionUrl">
                    {{ $secondaryActionText }}
                </x-button>
            @endif
        </div>
    @endif
</div>
