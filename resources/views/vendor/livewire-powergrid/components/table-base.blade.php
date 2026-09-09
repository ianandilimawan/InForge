@props([
    'readyToLoad' => false,
    'items' => null,
    'lazy' => false,
    'tableName' => null,
    'theme' => null,
])
<div @isset($this->setUp['responsive']) x-data="pgResponsive" @endisset>
    <div x-data="{ expandedId: null }">
        <table
            id="table_base_{{ $tableName }}"
            class="w-full text-left border-collapse text-xs sm:text-sm bg-white dark:bg-zinc-900 {{ theme_style($theme, 'table.layout.table') }}"
        >
            <thead
                class="{{ theme_style($theme, 'table.header.thead') }}"
            >
                {{ $header }}
            </thead>
            @if ($readyToLoad)
                <tbody
                    class="{{ theme_style($theme, 'table.body.tbody') }}"
                >
                    {{ $body }}
                </tbody>
            @else
                <tbody
                    class="{{ theme_style($theme, 'table.body.tbody') }}"
                >
                    {{ $loading }}
                </tbody>
            @endif
        </table>
    </div>

    {{-- infinite pagination handler --}}
    @if ($this->canLoadMore && $lazy)
        <div class="justify-center items-center" wire:loading.class="flex" wire:target="loadMore">
            @include(data_get($theme, 'root') . '.header.loading')
        </div>

        <div x-data="pgLoadMore"></div>
    @endif

    <x-livewire-powergrid::support-livewire-v4 />
</div>
