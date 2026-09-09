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
                        $importButton = "<x-button href=\"{{ route('{$routeName}.export') }}?format=csv\" variant=\"warning\" icon=\"download\">
                    Export CSV
                </x-button>
                <x-button href=\"{{ route('{$routeName}.importForm') }}\" variant=\"secondary\" icon=\"upload\">
                    Import Data
                </x-button>";
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
