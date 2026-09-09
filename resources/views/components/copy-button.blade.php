@props([
    'text' => '',
    'value' => null,
    'label' => null,
    'copiedLabel' => 'Copied!',
    'size' => 'sm',
    'variant' => 'ghost',
    'class' => '',
])

@php
    $copyValue = $value ?? $text;

    $sizeClasses = [
        'xs' => 'px-2 py-1 text-[11px] gap-1',
        'sm' => 'px-2.5 py-1.5 text-xs gap-1.5',
        'md' => 'px-3.5 py-2 text-sm gap-2',
    ][$size] ?? 'px-2.5 py-1.5 text-xs gap-1.5';

    $iconSizes = [
        'xs' => 'w-3 h-3',
        'sm' => 'w-3.5 h-3.5',
        'md' => 'w-4 h-4',
    ][$size] ?? 'w-3.5 h-3.5';

    $variantClasses = [
        'ghost' => 'text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 hover:bg-zinc-100 dark:hover:bg-zinc-800',
        'outline' => 'border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800/80 text-zinc-700 dark:text-zinc-200 hover:bg-zinc-50 dark:hover:bg-zinc-800 shadow-2xs',
        'solid' => 'bg-zinc-900 hover:bg-zinc-800 text-white dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:text-white border border-zinc-900 dark:border-zinc-600 shadow-xs',
        'secondary' => 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700 border border-zinc-200/60 dark:border-zinc-700/60',
    ][$variant] ?? 'text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 hover:bg-zinc-100 dark:hover:bg-zinc-800';
@endphp

<button
    type="button"
    x-data="{
        copied: false,
        textToCopy: @js($copyValue),
        copy() {
            if (!this.textToCopy && this.$el.dataset.copy) {
                this.textToCopy = this.$el.dataset.copy;
            }
            if (!this.textToCopy) return;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(this.textToCopy);
            } else {
                const textarea = document.createElement('textarea');
                textarea.value = this.textToCopy;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                document.body.appendChild(textarea);
                textarea.select();
                try { document.execCommand('copy'); } catch (err) {}
                document.body.removeChild(textarea);
            }
            this.copied = true;
            setTimeout(() => { this.copied = false; }, 2000);
        }
    }"
    @click="copy"
    :title="copied ? 'Copied to clipboard!' : 'Copy to clipboard'"
    aria-label="Copy to clipboard"
    {{ $attributes->merge(['class' => "inline-flex items-center justify-center font-medium rounded-xl transition-all duration-150 cursor-pointer select-none active:scale-95 {$sizeClasses} {$variantClasses} {$class}"]) }}
>
    <!-- Default Copy Icon -->
    <svg x-show="!copied" class="{{ $iconSizes }} shrink-0 transition-transform duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
    </svg>

    <!-- Success Checkmark Icon -->
    <svg x-show="copied" x-cloak class="{{ $iconSizes }} shrink-0 text-emerald-500 transition-transform duration-150 animate-in zoom-in-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>

    @if ($label)
        <span x-text="copied ? '{{ $copiedLabel }}' : '{{ $label }}'" class="truncate"></span>
    @endif

    {{ $slot }}
</button>
