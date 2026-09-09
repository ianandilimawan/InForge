@props([
    'id' => null,
    'name' => null,
    'title' => null,
    'subtitle' => null,
    'size' => 'lg', // sm, md, lg, xl, 2xl, 3xl, 4xl, full
    'dismissible' => true,
    'icon' => null,
])

@php
    $modalId = $id ?? $name ?? ('modal-' . \Illuminate\Support\Str::random(8));

    $maxWidthClass = match($size) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        'full' => 'max-w-5xl',
        default => 'max-w-lg',
    };

    $iconSvg = match($icon) {
        'check', 'success' => '<div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>',
        'trash', 'danger', 'delete' => '<div class="w-8 h-8 rounded-full bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></div>',
        'warning', 'alert' => '<div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg></div>',
        'info', 'information' => '<div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>',
        default => null,
    };
@endphp

<div x-data="{ open: false }"
    @open-modal.window="if ($event.detail === '{{ $modalId }}' || $event.detail?.name === '{{ $modalId }}') open = true"
    @close-modal.window="if ($event.detail === '{{ $modalId }}' || $event.detail?.name === '{{ $modalId }}') open = false"
    @keydown.escape.window="if ({{ $dismissible ? 'true' : 'false' }}) open = false"
    x-init="$watch('open', value => { if (value) { document.body.classList.add('overflow-hidden'); } else { document.body.classList.remove('overflow-hidden'); } })">

    <template x-teleport="body">
        <div x-show="open"
            style="display: none;"
            class="fixed inset-0 z-[99999] overflow-y-auto flex items-center justify-center p-4 sm:p-6"
            aria-labelledby="{{ $modalId }}-title"
            role="dialog"
            aria-modal="true">

            <!-- Backdrop Overlay with Blur -->
            <div x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="{{ $dismissible ? 'open = false' : '' }}"
                class="fixed inset-0 bg-zinc-950/70 backdrop-blur-md transition-opacity"></div>

            <!-- Centered Modal Card -->
            <div x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                class="relative w-full {{ $maxWidthClass }} transform rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 text-left shadow-2xl transition-all my-auto z-10">

                <!-- Modal Header -->
                @if (isset($header))
                    <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        {{ $header }}
                        @if ($dismissible)
                            <button type="button" @click="open = false"
                                class="p-1.5 rounded-lg text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        @endif
                    </div>
                @elseif ($title || $icon)
                    <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                            @if ($iconSvg)
                                {!! $iconSvg !!}
                            @endif
                            <div>
                                @if ($title)
                                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white" id="{{ $modalId }}-title">
                                        {{ $title }}
                                    </h3>
                                @endif
                                @if ($subtitle)
                                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                                        {{ $subtitle }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        @if ($dismissible)
                            <button type="button" @click="open = false"
                                class="p-1.5 rounded-lg text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors -mr-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        @endif
                    </div>
                @endif

                <!-- Modal Content Body -->
                <div class="px-6 py-5 text-sm text-zinc-600 dark:text-zinc-300">
                    {{ $slot }}
                </div>

                <!-- Modal Action Footer -->
                @if (isset($footer))
                    <div class="bg-zinc-50/70 dark:bg-zinc-800/30 border-t border-zinc-100 dark:border-zinc-800 px-6 py-3.5 flex items-center justify-end gap-3 rounded-b-2xl">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </template>
</div>

@once
    @push('scripts')
        <script>
            window.openModal = function(id) {
                window.dispatchEvent(new CustomEvent('open-modal', { detail: id }));
            };
            window.closeModal = function(id) {
                window.dispatchEvent(new CustomEvent('close-modal', { detail: id }));
            };
        </script>
    @endpush
@endonce
