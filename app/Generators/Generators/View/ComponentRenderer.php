<?php

namespace App\Generators\Generators\View;

use App\Generators\Common\CommandData;
use App\Generators\Utils\FileUtil;

class ComponentRenderer
{
    protected CommandData $commandData;

    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
    }

    public function getFileUploadComponent($field, string $fieldLabel): string
    {
        $fieldName = $field->name;
        return <<<HTML
        <x-filepond name="{$fieldName}" label="{$fieldLabel}" :defaultFile="isset(\$fileUrls['{$fieldName}']) ? \$fileUrls['{$fieldName}'] : null" />
HTML;
    }

    public function getDropifyComponent($field, string $fieldLabel): string
    {
        return $this->getFileUploadComponent($field, $fieldLabel);
    }

    public function getTagifyComponent($field, string $fieldLabel): string
    {
        $fieldName = $field->name;
        $modelVar = $this->commandData->modelNameCamel;
        $html = <<<HTML
        <div>
            <label for="{$fieldName}" class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1.5">{$fieldLabel}</label>
            <input name="{$fieldName}" id="{$fieldName}" value="{{ \${$modelVar}->{$fieldName} ?? '' }}" placeholder="Add tags..." class="block w-full rounded-xl border border-zinc-200/80 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 px-3.5 py-2.5 text-xs transition-colors">
            @error('{$fieldName}')
                <p class="mt-1 text-xs text-rose-500 font-medium">{{ \$message }}</p>
            @enderror
        </div>
HTML;
        try {
            $scriptTemplate = FileUtil::getStubContents('js/tagify-init.js');
            $scriptTemplate = str_replace('{{fieldName}}', $fieldName, $scriptTemplate);
            return $html . "\n@push('scripts')\n<script>\n" . $scriptTemplate . "\n</script>\n@endpush";
        } catch (\Exception $e) {
            return $html;
        }
    }

    public function getPasswordFieldWithStrength($field, string $fieldLabel): string
    {
        $fieldName = $field->name;
        return <<<HTML
        <x-password name="{$fieldName}" label="{$fieldLabel}" :strength="true" />
HTML;
    }
}
