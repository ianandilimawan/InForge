@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-tight text-zinc-900 dark:text-white">Activity Log Details</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Detailed audit record and attribute changes for this event</p>
            </div>
            <x-button href="{{ route('admin.activity-logs.index') }}" variant="secondary" icon="arrow-left">
                Back to Logs
            </x-button>
        </div>

        <!-- Activity Log Details Card -->
        <x-card title="Activity Information" subtitle="Metadata recorded for this audit entry.">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <span class="block text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1.5">Action</span>
                    @php
                        $variant = match(strtolower($activityLog->action)) {
                            'create' => 'emerald',
                            'update' => 'blue',
                            'delete' => 'rose',
                            default => 'zinc'
                        };
                    @endphp
                    <x-badge :variant="$variant" size="md" :dot="true">
                        {{ ucfirst($activityLog->action) }}
                    </x-badge>
                </div>
                <div>
                    <span class="block text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1">Target Model</span>
                    <p class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $activityLog->model_type }}</p>
                    @if ($activityLog->model_id)
                        <p class="text-xs text-zinc-400 dark:text-zinc-500 font-mono">ID: #{{ $activityLog->model_id }}</p>
                    @endif
                </div>
                <div>
                    <span class="block text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1">Triggered By</span>
                    @if ($activityLog->user)
                        <p class="text-sm font-bold text-zinc-900 dark:text-zinc-100">{{ $activityLog->user->name }}</p>
                        <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $activityLog->user->email }}</p>
                    @else
                        <span class="text-xs text-zinc-400 dark:text-zinc-500 italic">System / Cron</span>
                    @endif
                </div>
                <div>
                    <span class="block text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1">Timestamp</span>
                    <p class="text-sm font-bold text-zinc-900 dark:text-zinc-100">
                        {{ $activityLog->created_at->format('Y-m-d H:i:s') }}
                    </p>
                    <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $activityLog->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                <span class="block text-xs font-bold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1">Description</span>
                <p class="text-sm text-zinc-800 dark:text-zinc-200 bg-zinc-50 dark:bg-zinc-800/50 p-3 rounded-xl border border-zinc-200/60 dark:border-zinc-700/60">{{ $activityLog->description }}</p>
            </div>
        </x-card>

        <!-- Data Changes -->
        @if (($activityLog->old_values && !empty($activityLog->old_values)) || ($activityLog->new_values && !empty($activityLog->new_values)))
            <x-card :title="strtolower($activityLog->action) === 'update' ? 'Data Attribute Changes' : 'Data Payload Details'" subtitle="Field values recorded before and after this event occurred.">
                @php
                    $old = is_array($activityLog->old_values) ? $activityLog->old_values : [];
                    $new = is_array($activityLog->new_values) ? $activityLog->new_values : [];
                    $allKeys = array_unique(array_merge(array_keys($old), array_keys($new)));
                    
                    $changedKeys = [];
                    $unchangedKeys = [];
                    
                    foreach ($allKeys as $key) {
                        if (strtolower($activityLog->action) === 'update') {
                            $existsInOld = array_key_exists($key, $old);
                            $existsInNew = array_key_exists($key, $new);
                            
                            if (!$existsInNew) {
                                $unchangedKeys[] = $key;
                                continue;
                            }
                            
                            $oldVal = $existsInOld ? $old[$key] : null;
                            $newVal = $new[$key];
                            
                            if (is_numeric($oldVal) && is_numeric($newVal)) {
                                if ((float)$oldVal != (float)$newVal) {
                                    $changedKeys[] = $key;
                                } else {
                                    $unchangedKeys[] = $key;
                                }
                            } else if ($oldVal !== $newVal) {
                                $changedKeys[] = $key;
                            } else {
                                $unchangedKeys[] = $key;
                            }
                        } else {
                            $changedKeys[] = $key;
                        }
                    }
                    
                    if (strtolower($activityLog->action) === 'delete' && in_array('deleted_at', $allKeys)) {
                        if (array_key_exists('deleted_at', $old) && empty($old['deleted_at'])) {
                            $old['deleted_at'] = $activityLog->created_at->format('Y-m-d H:i:s');
                        }
                    }
                    
                    $sortFunc = function($a, $b) {
                        $bottomKeysOrder = ['created_at' => 1, 'updated_at' => 2, 'deleted_at' => 3];
                        
                        $aIsBottom = isset($bottomKeysOrder[$a]);
                        $bIsBottom = isset($bottomKeysOrder[$b]);
                        
                        if ($aIsBottom && !$bIsBottom) return 1;
                        if (!$aIsBottom && $bIsBottom) return -1;
                        if ($aIsBottom && $bIsBottom) {
                            return $bottomKeysOrder[$a] <=> $bottomKeysOrder[$b];
                        }
                        
                        $aIsId = ($a === 'id');
                        $bIsId = ($b === 'id');
                        
                        if ($aIsId && !$bIsId) return -1;
                        if (!$aIsId && $bIsId) return 1;
                        
                        return strcmp($a, $b);
                    };
                    
                    usort($changedKeys, $sortFunc);
                    usort($unchangedKeys, $sortFunc);
                    
                    $displayKeys = strtolower($activityLog->action) === 'update' ? $changedKeys : $allKeys;
                    
                    if (strtolower($activityLog->action) !== 'update') {
                        usort($displayKeys, $sortFunc);
                    }
                @endphp

                <x-table>
                    <x-slot:header>
                        <tr>
                            <th scope="col" class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400 w-1/4">Field</th>
                            @if(strtolower($activityLog->action) === 'update')
                                <th scope="col" class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Previous Value</th>
                                <th scope="col" class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">New Value</th>
                            @else
                                <th scope="col" class="py-3.5 px-4 text-left font-bold text-[11px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Recorded Data</th>
                            @endif
                        </tr>
                    </x-slot:header>

                    @foreach($displayKeys as $key)
                        @php
                            $oldVal = array_key_exists($key, $old) ? $old[$key] : null;
                            $newVal = array_key_exists($key, $new) ? $new[$key] : null;
                        @endphp
                        <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="py-3.5 px-4 whitespace-nowrap font-bold text-zinc-900 dark:text-zinc-100">
                                {{ ucwords(str_replace('_', ' ', $key)) }}
                            </td>
                            @if(strtolower($activityLog->action) === 'update')
                                <td class="py-3.5 px-4 text-zinc-600 dark:text-zinc-400 font-mono text-xs">
                                    @if(array_key_exists($key, $old))
                                        <span class="inline-block px-2 py-0.5 rounded bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 line-through mr-2">
                                            {{ is_array($oldVal) ? json_encode($oldVal) : ($oldVal ?? 'null') }}
                                        </span>
                                    @else
                                        <span class="text-zinc-400 dark:text-zinc-600 italic">-</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-zinc-600 dark:text-zinc-400 font-mono text-xs">
                                    @if(array_key_exists($key, $new))
                                        <span class="inline-block px-2 py-0.5 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold">
                                            {{ is_array($newVal) ? json_encode($newVal) : ($newVal ?? 'null') }}
                                        </span>
                                    @else
                                        <span class="text-zinc-400 dark:text-zinc-600 italic">-</span>
                                    @endif
                                </td>
                            @else
                                <td class="px-5 py-3.5 text-zinc-700 dark:text-zinc-300 font-mono text-xs">
                                    @php
                                        $val = strtolower($activityLog->action) === 'delete' ? $oldVal : $newVal;
                                    @endphp
                                    {{ is_array($val) ? json_encode($val) : ($val ?? 'null') }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </x-table>
            </x-card>
        @endif
    </div>
@endsection
