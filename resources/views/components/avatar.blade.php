@props([
    'src' => null,
    'name' => 'User',
    'size' => 'md', // 'xs', 'sm', 'md', 'lg', 'xl'
    'status' => null, // 'online', 'offline', 'busy', 'away'
    'shape' => 'circle', // 'circle', 'rounded'
    'class' => '',
])

@php
    $sizeClasses = match($size) {
        'xs' => 'w-6 h-6 text-[10px]',
        'sm' => 'w-8 h-8 text-xs',
        'lg' => 'w-12 h-12 text-base',
        'xl' => 'w-14 h-14 text-lg font-bold',
        default => 'w-10 h-10 text-sm font-semibold',
    };

    $statusSize = match($size) {
        'xs' => 'w-1.5 h-1.5',
        'sm' => 'w-2 h-2',
        'lg' => 'w-3 h-3',
        'xl' => 'w-3.5 h-3.5',
        default => 'w-2.5 h-2.5',
    };

    $statusColor = match($status) {
        'online' => 'bg-emerald-500 ring-white dark:ring-zinc-900',
        'busy' => 'bg-rose-500 ring-white dark:ring-zinc-900',
        'away' => 'bg-amber-500 ring-white dark:ring-zinc-900',
        default => 'bg-zinc-400 ring-white dark:ring-zinc-900',
    };

    $shapeClass = $shape === 'rounded' ? 'rounded-xl' : 'rounded-full';

    // Generate Initials
    $words = explode(' ', trim($name));
    $initials = '';
    if (count($words) >= 2) {
        $initials = mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1);
    } else {
        $initials = mb_substr($name, 0, 2);
    }
    $initials = strtoupper($initials);

    // Deterministic soft gradient background based on name
    $gradients = [
        'from-emerald-500 to-teal-700 text-white',
        'from-blue-500 to-indigo-700 text-white',
        'from-purple-500 to-pink-700 text-white',
        'from-rose-500 to-orange-600 text-white',
        'from-amber-500 to-orange-600 text-white',
        'from-zinc-700 to-zinc-900 text-white',
    ];
    $gradientIndex = abs(crc32($name)) % count($gradients);
    $bgGradient = $gradients[$gradientIndex];
@endphp

<div class="relative inline-block shrink-0 {{ $class }}">
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name }}" class="{{ $sizeClasses }} {{ $shapeClass }} object-cover border border-zinc-200/80 dark:border-zinc-800 shadow-sm">
    @else
        <div class="{{ $sizeClasses }} {{ $shapeClass }} bg-gradient-to-br {{ $bgGradient }} flex items-center justify-center font-bold tracking-tight shadow-sm select-none border border-black/10 dark:border-white/10">
            {{ $initials }}
        </div>
    @endif

    @if ($status)
        <span class="absolute bottom-0 right-0 block {{ $statusSize }} rounded-full ring-2 {{ $statusColor }}"></span>
    @endif
</div>
