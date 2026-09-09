<?php

namespace App\Livewire;

use PowerComponents\LivewirePowerGrid\Themes\Theme;

class PowerGridTheme extends Theme
{
    public string $name = 'tailwind';

    public function table(): array
    {
        return [
            'layout' => [
                'base' => 'w-full bg-white dark:bg-zinc-900 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-zinc-200/80 dark:border-zinc-800 p-4 sm:p-5 space-y-4',
                'div' => 'rounded-xl relative border border-zinc-200/80 dark:border-zinc-800 overflow-x-auto min-h-[260px]',
                'table' => 'w-full text-left border-collapse text-xs sm:text-sm bg-white dark:bg-zinc-900',
                'container' => 'overflow-x-auto',
                'actions' => 'flex items-center gap-2',
            ],

            'header' => [
                'thead' => 'bg-zinc-50/80 dark:bg-zinc-800/60 border-b border-zinc-200/80 dark:border-zinc-800 text-[11px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400',
                'tr' => '',
                'th' => 'py-3.5 px-4 font-bold text-left text-[11px] text-zinc-500 dark:text-zinc-400 uppercase tracking-wider whitespace-nowrap',
                'thAction' => 'py-3.5 px-4 font-bold text-right text-[11px] text-zinc-500 dark:text-zinc-400 uppercase tracking-wider whitespace-nowrap',
            ],

            'body' => [
                'tbody' => 'divide-y divide-zinc-100 dark:divide-zinc-800/80 text-zinc-700 dark:text-zinc-300',
                'tbodyEmpty' => 'p-8 text-center text-xs text-zinc-400 dark:text-zinc-500',
                'tr' => 'bg-white dark:bg-zinc-900 hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors',
                'td' => 'py-3.5 px-4 text-xs sm:text-sm text-zinc-800 dark:text-zinc-200 whitespace-nowrap',
                'tdEmpty' => 'p-6 text-center text-xs text-zinc-400 dark:text-zinc-500',
                'tdSummarize' => 'p-3 whitespace-nowrap text-xs text-zinc-500 dark:text-zinc-400 text-right space-y-2',
                'trSummarize' => '',
                'tdFilters' => '',
                'trFilters' => '',
                'tdActionsContainer' => 'flex items-center justify-end gap-1',
            ],
        ];
    }

    public function footer(): array
    {
        return [
            'view' => $this->root().'.footer',
            'select' => 'appearance-none bg-zinc-50 dark:bg-zinc-800 border border-zinc-200/80 dark:border-zinc-700 text-xs text-zinc-700 dark:text-zinc-300 rounded-xl py-1 px-2.5 pr-6 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:outline-none transition-colors cursor-pointer',
            'footer' => 'mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-zinc-500 dark:text-zinc-400',
            'footer_with_pagination' => 'flex flex-col sm:flex-row w-full items-center justify-between gap-3 text-xs text-zinc-500 dark:text-zinc-400',
        ];
    }

    public function cols(): array
    {
        return [
            'div' => 'select-none flex items-center gap-1.5 font-bold text-zinc-500 dark:text-zinc-400 text-[11px] uppercase tracking-wider',
        ];
    }

    public function editable(): array
    {
        return [
            'view' => $this->root().'.editable',
            'input' => 'focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 w-full transition-colors focus:outline-none',
        ];
    }

    public function toggleable(): array
    {
        return [
            'view' => $this->root().'.toggleable',
        ];
    }

    public function checkbox(): array
    {
        return [
            'th' => 'py-3.5 px-4 w-12 text-center',
            'base' => '',
            'label' => 'flex items-center justify-center',
            'input' => 'w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-emerald-600 focus:ring-emerald-500 dark:bg-zinc-800 dark:ring-offset-zinc-900 cursor-pointer',
        ];
    }

    public function radio(): array
    {
        return [
            'th' => 'py-3.5 px-4 w-12 text-center',
            'base' => '',
            'label' => 'flex items-center justify-center',
            'input' => 'w-4 h-4 text-emerald-600 border-zinc-300 dark:border-zinc-700 focus:ring-emerald-500 dark:bg-zinc-800 dark:ring-offset-zinc-900 cursor-pointer',
        ];
    }

    public function filterBoolean(): array
    {
        return [
            'view' => $this->root().'.filters.boolean',
            'base' => 'min-w-[5rem]',
            'select' => 'appearance-none bg-zinc-50 dark:bg-zinc-800 border border-zinc-200/80 dark:border-zinc-700 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 pr-6 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none transition-colors w-full cursor-pointer',
        ];
    }

    public function filterDatePicker(): array
    {
        return [
            'base' => '',
            'view' => $this->root().'.filters.date-picker',
            'input' => 'flatpickr flatpickr-input border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none transition-colors w-auto',
        ];
    }

    public function filterMultiSelect(): array
    {
        return [
            'view' => $this->root().'.filters.multi-select',
            'base' => 'inline-block relative w-full',
            'select' => 'mt-1',
        ];
    }

    public function filterNumber(): array
    {
        return [
            'view' => $this->root().'.filters.number',
            'input' => 'w-full min-w-[5rem] block border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none transition-colors',
        ];
    }

    public function filterSelect(): array
    {
        return [
            'view' => $this->root().'.filters.select',
            'base' => '',
            'select' => 'appearance-none bg-zinc-50 dark:bg-zinc-800 border border-zinc-200/80 dark:border-zinc-700 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 pr-6 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none transition-colors w-full cursor-pointer',
        ];
    }

    public function filterInputText(): array
    {
        return [
            'view' => $this->root().'.filters.input-text',
            'base' => 'min-w-[9.5rem]',
            'select' => 'appearance-none bg-zinc-50 dark:bg-zinc-800 border border-zinc-200/80 dark:border-zinc-700 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 pr-6 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none transition-colors w-full cursor-pointer',
            'input' => 'border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-xs text-zinc-900 dark:text-zinc-100 rounded-xl py-1.5 px-2.5 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 focus:outline-none transition-colors w-full',
        ];
    }

    public function searchBox(): array
    {
        return [
            'input' => 'w-full sm:w-64 pl-9 pr-3 py-2 text-xs rounded-xl border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-500 focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-colors',
            'iconClose' => 'text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer',
            'iconSearch' => 'text-zinc-400 w-4 h-4 mr-2',
        ];
    }
}
