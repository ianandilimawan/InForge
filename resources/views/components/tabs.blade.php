@props([
    'tabs' => [], // [ ['id' => 'overview', 'label' => 'Overview', 'badge' => null, 'icon' => null], ... ]
    'active' => null,
    'variant' => 'pills', // 'pills' or 'underline'
    'class' => '',
])

@php
    $defaultActive = $active ?? ($tabs[0]['id'] ?? '');
@endphp

<div x-data="{ activeTab: '{{ $defaultActive }}' }" class="space-y-4 {{ $class }}">
    @if ($variant === 'underline')
        <div class="border-b border-zinc-200/80 dark:border-zinc-800">
            <nav class="-mb-px flex space-x-6 overflow-x-auto no-scrollbar" aria-label="Tabs">
                @foreach ($tabs as $tab)
                    @php
                        $tabId = $tab['id'] ?? \Illuminate\Support\Str::slug($tab['label'] ?? '');
                    @endphp
                    <button type="button"
                        @click="activeTab = '{{ $tabId }}'"
                        :class="activeTab === '{{ $tabId }}' 
                            ? 'border-emerald-500 text-emerald-600 dark:text-emerald-400 font-bold' 
                            : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200 hover:border-zinc-300 font-medium'"
                        class="whitespace-nowrap py-3 px-1 border-b-2 text-xs sm:text-sm flex items-center gap-2 transition-colors cursor-pointer">
                        @if (!empty($tab['icon']))
                            <span class="w-4 h-4 shrink-0">{!! $tab['icon'] !!}</span>
                        @endif
                        <span>{{ $tab['label'] }}</span>
                        @if (isset($tab['badge']) && $tab['badge'] !== null)
                            <span :class="activeTab === '{{ $tabId }}' 
                                ? 'bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300' 
                                : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400'"
                                class="px-2 py-0.5 rounded-full text-[10px] font-bold border border-zinc-200/60 dark:border-zinc-700/60">
                                {{ $tab['badge'] }}
                            </span>
                        @endif
                    </button>
                @endforeach
            </nav>
        </div>
    @else
        {{-- Modern Pills Segmented Style --}}
        <div class="inline-flex p-1 rounded-xl bg-zinc-100/90 dark:bg-zinc-800/80 border border-zinc-200/60 dark:border-zinc-700/60 max-w-full overflow-x-auto no-scrollbar">
            @foreach ($tabs as $tab)
                @php
                    $tabId = $tab['id'] ?? \Illuminate\Support\Str::slug($tab['label'] ?? '');
                @endphp
                <button type="button"
                    @click="activeTab = '{{ $tabId }}'"
                    :class="activeTab === '{{ $tabId }}' 
                        ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-sm font-bold border border-zinc-200/80 dark:border-zinc-700' 
                        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200 font-medium border border-transparent'"
                    class="px-3.5 py-1.5 rounded-lg text-xs sm:text-[13px] flex items-center gap-2 transition-all duration-150 cursor-pointer shrink-0">
                    @if (!empty($tab['icon']))
                        <span class="w-3.5 h-3.5 shrink-0">{!! $tab['icon'] !!}</span>
                    @endif
                    <span>{{ $tab['label'] }}</span>
                    @if (isset($tab['badge']) && $tab['badge'] !== null)
                        <span :class="activeTab === '{{ $tabId }}' 
                            ? 'bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300' 
                            : 'bg-zinc-200/70 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-300'"
                            class="px-1.5 py-0.2 rounded-full text-[10px] font-bold">
                            {{ $tab['badge'] }}
                        </span>
                    @endif
                </button>
            @endforeach
        </div>
    @endif

    {{-- Slot for Tab Panels --}}
    <div class="tab-content">
        {{ $slot }}
    </div>
</div>
