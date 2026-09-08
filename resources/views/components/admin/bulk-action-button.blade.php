<div class="mb-3" x-cloak x-show="window.pgBulkActions && window.pgBulkActions.count('{{ $tableName }}') > 0">
    <button type="button"
        x-on:click="$wire.triggerBulkDelete(window.pgBulkActions.get('{{ $tableName }}'))"
        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 bg-red-50 dark:bg-red-950/60 hover:bg-red-100 dark:hover:bg-red-900/60 border border-red-200/60 dark:border-red-800/60 rounded-xl transition-all cursor-pointer shadow-2xs">
        <svg class="w-3.5 h-3.5" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg> 
        Bulk Delete (<span x-text="window.pgBulkActions ? window.pgBulkActions.count('{{ $tableName }}') : 0"></span>)
    </button>
</div>
