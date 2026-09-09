<?php

namespace App\Livewire\Tables;

use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Button;
use Livewire\Attributes\On;

class UserTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'user-table';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('export_users_' . now()->format('Ymd_His'))
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
        return User::query()->with('roles');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('roles_display', function (User $row) {
                if ($row->roles->isEmpty()) {
                    return '<span class="text-zinc-400 dark:text-zinc-500 text-xs">-</span>';
                }

                return $row->roles->map(function ($role) {
                    return '<span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-purple-100 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300 border border-purple-200/60 dark:border-purple-800/60">'
                        . e($role->name) . '</span>';
                })->implode(' ');
            })
            ->add('status_display', function (User $row) {
                return '<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active</span>';
            })
            ->add('action', function (User $row) {
                $canEdit = auth()->user() && auth()->user()->hasPermission('edit-users');
                $canDelete = auth()->user() && auth()->user()->hasPermission('delete-users');

                if (!$canEdit && !$canDelete) {
                    return '<span class="text-zinc-400 dark:text-zinc-500 text-xs">-</span>';
                }

                return view('components.table-actions', [
                    'editUrl' => $canEdit ? route('admin.users.edit', $row->id) : null,
                    'deleteUrl' => $canDelete ? route('admin.users.destroy', $row->id) : null,
                    'editLabel' => 'Edit User',
                    'deleteLabel' => 'Delete User',
                ])->render();
            });
    }

    public function columns(): array
    {
        return [
            Column::add()->title('No')->index()
                ->headerAttribute('text-center')
                ->bodyAttribute('text-center'),
            Column::make('User', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Roles', 'roles_display')
                ->visibleInExport(false),

            Column::make('Status', 'status_display')
                ->visibleInExport(false),

            Column::make('Action', 'action')
                ->headerAttribute('text-center')
                ->bodyAttribute('text-center')
                ->visibleInExport(false),
        ];
    }



    #[On('triggerBulkDelete')]
    public function triggerBulkDelete(?array $ids = null): void
    {
        if (!$ids) {
            $ids = $this->checkboxValues;
        }
        
        if (empty($ids)) return;
        
        // Ensure user has permission
        if (!auth()->user()->hasPermission('delete-users')) {
            $this->dispatch('toast', type: 'error', message: 'You do not have permission to delete users.');
            return;
        }

        // We trigger SweetAlert via browser event with the IDs
        $this->dispatch('confirm-bulk-delete', [
            'ids' => $ids,
            'model' => 'App\\\\Models\\\\User',
            'refreshRoute' => 'refreshDatatable'
        ]);
    }
    
    #[\Livewire\Attributes\On('bulkDeleteConfirmed')]
    public function bulkDeleteConfirmed($ids, $model): void
    {
        if (!auth()->user()->hasPermission('delete-users')) return;
        
        try {
            User::whereIn('id', $ids)->delete();
            ActivityLogService::logBulkDelete(User::class, count($ids), $ids);
            
            $this->js('window.pgBulkActions.clearAll()');
            $this->dispatch('notify', type: 'success', message: count($ids) . ' users have been deleted.');
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Failed to delete users.');
        }
    }
}
