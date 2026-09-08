<?php

namespace App\Generators\Generators;

use App\Generators\Utils\FileUtil;
use App\Generators\Common\CommandData;
use App\Generators\Generators\View\FormFieldRenderer;
use App\Generators\Generators\View\TableRenderer;
use App\Generators\Generators\View\ComponentRenderer;
use App\Generators\Generators\View\ImportExportRenderer;

class ViewGenerator extends BaseGenerator
{
    protected FormFieldRenderer $formRenderer;
    protected TableRenderer $tableRenderer;
    protected ComponentRenderer $componentRenderer;
    protected ImportExportRenderer $importRenderer;

    public function __construct(CommandData $commandData)
    {
        parent::__construct($commandData);
        $this->componentRenderer = new ComponentRenderer($commandData);
        $this->formRenderer = new FormFieldRenderer($commandData, $this->componentRenderer);
        $this->tableRenderer = new TableRenderer($commandData);
        $this->importRenderer = new ImportExportRenderer($commandData);
    }

    public function generate(): bool
    {
        try {
            $views = ['index', 'create', 'edit', 'show'];
            if ($this->commandData->withImport) {
                $views[] = 'import';
            }
            $success = true;

            // Generate fields.blade.php partial first
            try {
                $fieldsTemplate = $this->formRenderer->getFormFields();
                $fieldsOutputPath = FileUtil::getViewPath("{$this->commandData->getViewPath()}/fields");
                if (!$this->generateFile($fieldsTemplate, $fieldsOutputPath, [])) {
                    $success = false;
                }
            } catch (\Throwable $e) {
                \Log::error("Failed to generate fields partial: " . $e->getMessage());
                $success = false;
            }

            // Generate datatables_actions.blade.php partial for DataTables
            try {
                $actionsTemplate = FileUtil::getStubContents("view/datatables_actions");
                $actionsOutputPath = FileUtil::getViewPath("{$this->commandData->getViewPath()}/datatables_actions");
                if (!$this->generateFile($actionsTemplate, $actionsOutputPath, $this->getReplacements())) {
                    $success = false;
                }
            } catch (\Throwable $e) {
                \Log::error("Failed to generate datatables_actions partial: " . $e->getMessage());
                $success = false;
            }

            foreach ($views as $view) {
                try {
                    $template = FileUtil::getStubContents("view/{$view}");
                    $outputPath = FileUtil::getViewPath("{$this->commandData->getViewPath()}/{$view}");

                    $viewPath = $this->commandData->getViewPath();
                    $routeName = $this->commandData->getRouteName();

                    $importButton = "";
                    if ($this->commandData->withImport) {
                        $importButton = "<a href=\"{{ route('{$routeName}.export') }}?format=csv\"
                    class=\"inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-amber-700 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 bg-amber-50 dark:bg-amber-950/60 hover:bg-amber-100 dark:hover:bg-amber-900/60 border border-amber-200/60 dark:border-amber-800/60 rounded-xl transition-all cursor-pointer shadow-2xs\">
                    <svg class=\"w-3.5 h-3.5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4\"></path>
                    </svg>
                    <span>Export CSV</span>
                </a>
                <a href=\"{{ route('{$routeName}.importForm') }}\"
                    class=\"inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white bg-zinc-100/80 dark:bg-zinc-800/80 hover:bg-zinc-200/80 dark:hover:bg-zinc-700/80 border border-zinc-200/60 dark:border-zinc-700/60 rounded-xl transition-all cursor-pointer shadow-2xs\">
                    <svg class=\"w-3.5 h-3.5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12\"></path>
                    </svg>
                    <span>Import Data</span>
                </a>";
                    }

                    $replacements = array_merge($this->getReplacements(), [
                        '{{FORM_FIELDS}}' => "@include('{$viewPath}.fields')",
                        '{{TABLE_HEADERS}}' => $this->tableRenderer->getTableHeaders(),
                        '{{TABLE_CELLS}}' => $this->tableRenderer->getTableCells(),
                        '{{FORM_INPUTS}}' => $this->formRenderer->getFormInputs(),
                        '{{SHOW_FIELDS}}' => $this->tableRenderer->getShowFields(),
                        '{{FIELD_COUNT}}' => $this->tableRenderer->getFieldCount(),
                        '{{CSV_SAMPLE}}' => $this->importRenderer->getCsvSample(),
                        '{{IMPORT_BUTTON}}' => $importButton,
                    ]);

                    if (!$this->generateFile($template, $outputPath, $replacements)) {
                        $success = false;
                    }
                } catch (\Throwable $e) {
                    \Log::error("Failed to generate view {$view}: " . $e->getMessage());
                    $success = false;
                }
            }

            return $success;
        } catch (\Throwable $e) {
            \Log::error("ViewGenerator failed: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return false;
        }
    }

    public function rollback(): bool
    {
        $viewPath = resource_path("views/{$this->commandData->getViewPath()}");
        return FileUtil::deleteDirectory($viewPath);
    }
}
