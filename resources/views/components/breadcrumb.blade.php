@props([
    'items' => [], // [ ['label' => 'Users', 'url' => '/admin/users'], ['label' => 'Edit User', 'url' => null] ]
    'homeUrl' => null,
    'homeLabel' => 'Home',
    'class' => '',
])

@php
    $homeUrl = $homeUrl ?? (Route::has('admin.dashboard') ? route('admin.dashboard') : '/admin');
@endphp

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => "flex items-center text-xs font-medium text-zinc-500 dark:text-zinc-400 overflow-x-auto no-scrollbar py-1 {$class}"]) }}>
    <ol class="inline-flex items-center space-x-1 sm:space-x-2">
        {{-- Home Link --}}
        <li class="inline-flex items-center">
            <a href="{{ $homeUrl }}" class="inline-flex items-center gap-1.5 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>{{ $homeLabel }}</span>
            </a>
        </li>

        {{-- Dynamic Items --}}
        @foreach ($items as $item)
            <li class="inline-flex items-center">
                <svg class="w-3.5 h-3.5 text-zinc-300 dark:text-zinc-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                
                @if (!empty($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}" class="ml-1 sm:ml-2 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="ml-1 sm:ml-2 font-bold text-zinc-800 dark:text-zinc-200 truncate">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach

        {{-- Optional Slot for custom items --}}
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @endif
    </ol>
</nav>
