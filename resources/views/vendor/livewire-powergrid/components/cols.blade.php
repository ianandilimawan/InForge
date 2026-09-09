@props([
    'column' => null,
    'enabledFilters' => null,
    'actions' => null,
    'dataField' => null,
    'theme' => null,
])
@php
    $field = data_get($column, 'dataField', data_get($column, 'field'));

    $isFixedOnResponsive = false;

    if (isset($this->setUp['responsive'])) {
        if (in_array($field, data_get($this->setUp, 'responsive.fixedColumns'))) {
            $isFixedOnResponsive = true;
        }

        if (
            data_get($column, 'isAction') &&
            in_array(
                \PowerComponents\LivewirePowerGrid\Components\SetUp\Responsive::ACTIONS_COLUMN_NAME,
                data_get($this->setUp, 'responsive.fixedColumns'),
            )
        ) {
            $isFixedOnResponsive = true;
        }

        if (data_get($column, 'fixedOnResponsive')) {
            $isFixedOnResponsive = true;
        }
    }

    $sortOrder = isset($this->setUp['responsive'])
        ? data_get($this->setUp, "responsive.sortOrder.{$field}", null)
        : null;

    $isRight = str_contains((string) data_get($column, 'headerClass'), 'text-right') || $field === 'action' || data_get($column, 'isAction');
    $isCenter = str_contains((string) data_get($column, 'headerClass'), 'text-center');
    $thClass = theme_style($theme, 'table.header.th');
    if ($isRight) {
        $thClass = str_replace('text-left', 'text-right', $thClass);
    } elseif ($isCenter) {
        $thClass = str_replace('text-left', 'text-center', $thClass);
    }
    $isAction = data_get($column, 'isAction') || $field === 'action';
@endphp
<th x-data="{ sortable: @js(data_get($column, 'sortable')) }" data-column="{{ data_get($column, 'isAction') ? 'actions' : $field }}"
    @if ($sortOrder) sort_order="{{ $sortOrder }}" @endif
    @if ($isFixedOnResponsive) fixed @endif
    @if (data_get($column, 'enableSort')) x-multisort-shift-click="{{ $this->getId() }}"
    wire:click="sortBy('{{ $field }}')" @endif
    @class([
        $thClass => true,
        data_get($column, 'headerClass') => true,
        'sticky right-0 z-20 bg-zinc-50/95 dark:bg-zinc-800/95 backdrop-blur-xs border-l border-zinc-200/80 dark:border-zinc-700/80 shadow-[-4px_0_10px_-2px_rgba(0,0,0,0.05)] dark:shadow-[-4px_0_10px_-2px_rgba(0,0,0,0.3)] !px-2 text-center w-14 min-w-[56px] max-w-[56px]' => $isAction,
    ]) @style([
        'display:none' => data_get($column, 'hidden') === true,
        'cursor:pointer' => data_get($column, 'enableSort'),
        data_get($column, 'headerStyle') => filled(data_get($column, 'headerStyle')),
        'width: 56px !important' => $isAction,
        'width: max-content !important' => ! $isAction,
    ])>
    <div class="{{ theme_style($theme, 'cols.div') }} {{ $isAction ? 'justify-center text-center' : ($isRight ? 'justify-end text-right' : ($isCenter ? 'justify-center text-center' : '')) }}"
        @if($isAction || $isCenter) style="justify-content: center;"
        @elseif($isRight) style="justify-content: flex-end;" @endif>
        <span @class([
            'text-[10px] font-bold uppercase tracking-tight' => $isAction,
        ]) data-value>{!! data_get($column, 'title') !!}</span>

        @if (data_get($column, 'enableSort'))
            <x-dynamic-component component="{{ $this->sortIcon($field) }}" width="16" />
        @endif
    </div>
</th>
