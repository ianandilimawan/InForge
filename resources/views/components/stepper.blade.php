@props([
    'steps' => [], // [ ['title' => 'Step 1', 'description' => 'Account', 'status' => 'complete'], ... ]
    'class' => '',
])

<nav aria-label="Progress" class="w-full {{ $class }}">
    <ol class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-2 w-full">
        @foreach ($steps as $index => $step)
            @php
                $status = $step['status'] ?? 'upcoming'; // 'complete', 'current', 'upcoming'
                $stepNumber = $index + 1;
            @endphp

            <li class="relative flex-1 w-full md:w-auto">
                <div class="flex items-center gap-3">
                    {{-- Step Circle --}}
                    @if ($status === 'complete')
                        <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    @elseif ($status === 'current')
                        <div class="w-8 h-8 rounded-full border-2 border-emerald-600 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 font-bold text-xs flex items-center justify-center shrink-0 ring-4 ring-emerald-500/20">
                            {{ $stepNumber }}
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-full border border-zinc-300 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 font-semibold text-xs flex items-center justify-center shrink-0">
                            {{ $stepNumber }}
                        </div>
                    @endif

                    {{-- Step Text --}}
                    <div class="min-w-0 flex-1">
                        <div class="text-xs font-bold {{ $status === 'current' ? 'text-emerald-600 dark:text-emerald-400' : ($status === 'complete' ? 'text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-400') }}">
                            {{ $step['title'] }}
                        </div>
                        @if (!empty($step['description']))
                            <div class="text-[11px] text-zinc-400 dark:text-zinc-500 truncate">
                                {{ $step['description'] }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Connector Line (desktop only, except last item) --}}
                @if (!$loop->last)
                    <div class="hidden md:block absolute top-4 left-[calc(100%-2rem)] w-8 h-0.5 bg-zinc-200 dark:bg-zinc-800 -translate-y-1/2"></div>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
