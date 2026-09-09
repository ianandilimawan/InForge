@props([
    'id',
    'title' => null,
    'subtitle' => null,
    'width' => 'md', // 'sm', 'md', 'lg', 'xl'
    'footer' => null,
])

@php
    $widthClasses = match ($width) {
        'sm' => 'max-w-sm',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        default => 'max-w-md',
    };
@endphp

<div x-data="{
        show: false,
        init() {
            window.addEventListener('slideover-open-{{ $id }}', () => {
                this.show = true;
                document.body.classList.add('overflow-hidden');
            });
            window.addEventListener('slideover-close-{{ $id }}', () => {
                this.show = false;
                document.body.classList.remove('overflow-hidden');
            });
        },
        close() {
            this.show = false;
            document.body.classList.remove('overflow-hidden');
        }
    }"
    @keydown.escape.window="if (show) close()">

    <template x-teleport="body">
        <div x-show="show" class="relative z-[99999]" aria-labelledby="slideover-title-{{ $id }}" role="dialog" aria-modal="true" style="display: none;">
            {{-- Backdrop --}}
            <div x-show="show"
                x-transition:enter="ease-in-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in-out duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="close()"
                class="fixed inset-0 bg-zinc-950/60 backdrop-blur-sm transition-opacity"></div>

            <div class="fixed inset-0 overflow-hidden pointer-events-none">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        {{-- Sliding Panel --}}
                        <div x-show="show"
                            x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
                            x-transition:enter-start="translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transform transition ease-in-out duration-300 sm:duration-400"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full"
                            class="pointer-events-auto w-screen {{ $widthClasses }} bg-white dark:bg-zinc-900 border-l border-zinc-200/80 dark:border-zinc-800 shadow-2xl flex flex-col justify-between">
                            
                            {{-- Header --}}
                            <div class="p-5 sm:p-6 border-b border-zinc-100 dark:border-zinc-800 flex items-start justify-between gap-4">
                                <div>
                                    @if ($title)
                                        <h2 id="slideover-title-{{ $id }}" class="text-base font-bold text-zinc-900 dark:text-white tracking-tight">
                                            {{ $title }}
                                        </h2>
                                    @endif
                                    @if ($subtitle)
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                                            {{ $subtitle }}
                                        </p>
                                    @endif
                                </div>
                                <button type="button" @click="close()" class="p-1 rounded-lg text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer">
                                    <span class="sr-only">Close panel</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>

                            {{-- Scrollable Content Body --}}
                            <div class="p-5 sm:p-6 flex-1 overflow-y-auto space-y-4 text-xs text-zinc-600 dark:text-zinc-300">
                                {{ $slot }}
                            </div>

                            {{-- Footer Slot --}}
                            @if ($footer)
                                <div class="p-4 sm:p-5 bg-zinc-50/70 dark:bg-zinc-800/40 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-3">
                                    {{ $footer }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

@once
    @push('scripts')
        <script>
            window.openSlideover = function(id) {
                window.dispatchEvent(new CustomEvent('slideover-open-' + id));
            };
            window.closeSlideover = function(id) {
                window.dispatchEvent(new CustomEvent('slideover-close-' + id));
            };
        </script>
    @endpush
@endonce
