<?php

namespace App\Generators\Generators;

use App\Generators\Utils\FileUtil;

class PowerGridTableGenerator extends BaseGenerator
{
    public function generate(): bool
    {
        try {
            $dataTableName = $this->commandData->modelName . 'Table';
            $outputPath = FileUtil::getLivewireTablePath($dataTableName);

            $template = FileUtil::getStubContents('powergrid-table');

            $replacements = array_merge($this->getReplacements(), [
                '{{POWERGRID_FIELDS}}' => $this->getFields(),
                '{{POWERGRID_COLUMNS}}' => $this->getColumns(),
                '{{POWERGRID_FILTERS}}' => $this->getFilters(),
            ]);

            return $this->generateFile($template, $outputPath, $replacements);
        } catch (\Exception $e) {
            \Log::error("PowerGridTableGenerator failed: " . $e->getMessage());
            return false;
        }
    }

    public function rollback(): bool
    {
        $outputPath = FileUtil::getLivewireTablePath($this->commandData->modelName . 'Table');
        return FileUtil::delete($outputPath);
    }

    private function shouldSkipField($field): bool
    {
        $timestampFields = ['created_at', 'updated_at', 'deleted_at'];
        if (in_array($field->name, $timestampFields)) {
            return true;
        }
        if (in_array($field->htmlType, ['file', 'image'])) {
            return true;
        }
        $name = strtolower($field->name);
        return str_contains($name, 'image') || str_contains($name, 'photo') || str_ends_with($name, '_file') || $name === 'file' || str_contains($name, 'avatar') || str_contains($name, 'attachment');
    }

    private function getFields(): string
    {
        $fields = [];

        foreach ($this->commandData->fields as $field) {
            if ($this->shouldSkipField($field)) {
                continue;
            }

            $fieldName = $field->name;

            // Boolean fields render as badges
            if ($field->htmlType === 'checkbox' || $field->dbType === 'boolean') {
                $modelClass = $this->commandData->modelName;
                $fields[] = "            ->add('{$fieldName}_display', function ({$modelClass} \$row) {";
                $fields[] = "                if (\$row->{$fieldName}) {";
                $fields[] = "                    return '<span class=\"inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60\"><span class=\"w-1.5 h-1.5 rounded-full bg-emerald-500\"></span> Active</span>';";
                $fields[] = "                }";
                $fields[] = "                return '<span class=\"inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200/60 dark:border-zinc-700\"><span class=\"w-1.5 h-1.5 rounded-full bg-zinc-400\"></span> Inactive</span>';";
                $fields[] = "            })";
            } elseif ($field->htmlType === 'date' || $field->dbType === 'date') {
                $fields[] = "            ->add('{$fieldName}_formatted', fn (\$model) => \$model->{$fieldName} ? \Carbon\Carbon::parse(\$model->{$fieldName})->format('d/m/Y') : '-')";
            } elseif (in_array($field->htmlType, ['datetime', 'timestamp']) || in_array($field->dbType, ['datetime', 'timestamp'])) {
                $fields[] = "            ->add('{$fieldName}_formatted', fn (\$model) => \$model->{$fieldName} ? \Carbon\Carbon::parse(\$model->{$fieldName})->format('d/m/Y H:i') : '-')";
            } else {
                $fields[] = "            ->add('{$fieldName}')";
            }
        }

        return implode("\n", $fields);
    }

    private function getColumns(): string
    {
        $columns = [];

        foreach ($this->commandData->fields as $field) {
            if ($this->shouldSkipField($field)) {
                continue;
            }

            $fieldName = $field->name;
            $fieldTitle = ucwords(str_replace('_', ' ', $fieldName));

            if ($field->htmlType === 'checkbox' || $field->dbType === 'boolean') {
                $columns[] = "            Column::make('{$fieldTitle}', '{$fieldName}_display'),";
            } elseif (in_array($field->htmlType, ['date', 'datetime', 'timestamp']) || in_array($field->dbType, ['date', 'datetime', 'timestamp'])) {
                $columns[] = "            Column::make('{$fieldTitle}', '{$fieldName}_formatted', '{$fieldName}')->sortable()->searchable(),";
            } else {
                $columns[] = "            Column::make('{$fieldTitle}', '{$fieldName}')->sortable()->searchable(),";
            }
        }

        return implode("\n", $columns);
    }

    private function getFilters(): string
    {
        $filters = [];
        $timestampFields = ['created_at', 'updated_at', 'deleted_at'];

        foreach ($this->commandData->fields as $field) {
            if ($this->shouldSkipField($field)) {
                continue;
            }

            $fieldName = $field->name;

            if ($field->htmlType === 'checkbox' || $field->dbType === 'boolean') {
                $filters[] = "            Filter::boolean('{$fieldName}_display', '{$fieldName}'),";
            }
        }


        return implode("\n", $filters);
    }
}
