<?php

namespace App\Livewire\Tables;

use App\Models\Role;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

class RoleTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'role-table';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('export_roles_' . now()->format('Ymd_His'))
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            PowerGrid::header()
                ->showSearchInput()
                ->includeViewOnTop('components.admin.bulk-action-button'),
            PowerGrid::footer()
                ->showPerPage(10, [10, 25, 50, 100])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Role::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('is_active_display', function (Role $row) {
                if ($row->is_active) {
                    return '<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active</span>';
                }

                return '<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200/60 dark:border-zinc-700"><span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span> Inactive</span>';
            })
            ->add('action', function (Role $row) {
                $canEdit = auth()->user() && auth()->user()->hasPermission('edit-roles');
                $canDelete = auth()->user() && auth()->user()->hasPermission('delete-roles');

                if (!$canEdit && !$canDelete) {
                    return '<span class="text-zinc-400 dark:text-zinc-500 text-xs">-</span>';
                }

                return view('components.table-actions', [
                    'editUrl' => $canEdit ? route('admin.roles.edit', $row->id) : null,
                    'deleteUrl' => $canDelete ? route('admin.roles.destroy', $row->id) : null,
                    'editLabel' => 'Edit Role',
                    'deleteLabel' => 'Delete Role',
                ])->render();
            });
    }

    public function columns(): array
    {
        return [
            Column::add()->title('No')->index()
                ->headerAttribute('text-center')
                ->bodyAttribute('text-center'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description')
                ->searchable(),

            Column::make('Status', 'is_active_display')
                ->visibleInExport(false),

            Column::make('Actions', 'action')
                ->headerAttribute('text-right')
                ->bodyAttribute('text-right')
                ->visibleInExport(false),
        ];
    }



    #[\Livewire\Attributes\On('triggerBulkDelete')]
    public function triggerBulkDelete(?array $ids = null): void
    {
        if (!$ids) {
            $ids = $this->checkboxValues;
        }
        
        if (empty($ids)) return;
        
        if (!auth()->user()->hasPermission('delete-roles')) {
            $this->dispatch('toast', type: 'error', message: 'You do not have permission to delete roles.');
            return;
        }

        $this->dispatch('confirm-bulk-delete', [
            'ids' => $ids,
            'model' => 'App\\\\Models\\\\Role',
            'refreshRoute' => 'refreshDatatable'
        ]);
    }
    
    #[\Livewire\Attributes\On('bulkDeleteConfirmed')]
    public function bulkDeleteConfirmed($ids, $model): void
    {
        if (!auth()->user()->hasPermission('delete-roles')) return;
        
        try {
            Role::whereIn('id', $ids)->delete();
            ActivityLogService::logBulkDelete(Role::class, count($ids), $ids);
            
            $this->js('window.pgBulkActions.clearAll()');
            $this->dispatch('notify', type: 'success', message: count($ids) . ' roles have been deleted.');
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Failed to delete roles.');
        }
    }
}
