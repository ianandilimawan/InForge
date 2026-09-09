@props([
    'language' => 'bash',
    'title' => null,
    'lineNumbers' => false,
    'copyable' => true,
    'code' => null,
    'class' => '',
])

@php
    $content = trim($code ?? (string) $slot);
    $lines = explode("\n", $content);
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl border border-zinc-800/80 bg-zinc-950 text-zinc-200 overflow-hidden shadow-sm font-mono text-xs {$class}"]) }}>
    <!-- Header Bar -->
    <div class="flex items-center justify-between px-4 py-2.5 bg-zinc-900/90 border-b border-zinc-800/80 select-none">
        <div class="flex items-center gap-2">
            <!-- Mac Terminal Traffic Dots -->
            <div class="flex items-center gap-1.5 mr-2">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
            </div>

            @if ($title)
                <span class="text-[11px] font-semibold text-zinc-300 font-sans tracking-wide">{{ $title }}</span>
            @endif

            <span class="px-2 py-0.5 rounded-md text-[10px] uppercase font-bold tracking-wider bg-zinc-800 text-zinc-400 border border-zinc-700/50">
                {{ $language }}
            </span>
        </div>

        @if ($copyable)
            <x-copy-button
                :text="$content"
                size="xs"
                variant="ghost"
                label="Copy"
                copiedLabel="Copied!"
                class="text-zinc-400 hover:text-white hover:bg-zinc-800/80 font-sans"
            />
        @endif
    </div>

    <!-- Code Content -->
    <div class="p-4 overflow-x-auto text-[12px] leading-relaxed">
        @if ($lineNumbers)
            <table class="w-full border-collapse">
                <tbody>
                    @foreach ($lines as $i => $line)
                        <tr>
                            <td class="pr-4 text-right text-zinc-600 select-none align-top w-[1%] whitespace-nowrap">{{ $i + 1 }}</td>
                            <td class="text-zinc-200 whitespace-pre align-top">{{ $line }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <pre class="whitespace-pre font-mono text-zinc-200">{{ $content }}</pre>
        @endif
    </div>
</div>
