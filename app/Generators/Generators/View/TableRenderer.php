<?php

namespace App\Generators\Generators\View;

use App\Generators\Common\CommandData;

class TableRenderer
{
    protected CommandData $commandData;

    public function __construct(CommandData $commandData)
    {
        $this->commandData = $commandData;
    }

    public function getTableHeaders(): string
    {
        $headers = [];
        $timestampFields = ['created_at', 'updated_at', 'deleted_at'];

        // Always add ID column first
        $headers[] = "                            <th class=\"py-3.5 px-4 text-left font-bold text-[11px] text-zinc-500 dark:text-zinc-400 uppercase tracking-wider\">ID</th>";

        foreach ($this->commandData->fields as $field) {
            // Skip timestamp fields from table headers
            if (in_array($field->name, $timestampFields)) {
                continue;
            }

            if ($field->sortable) {
                $headers[] = "                            <th class=\"py-3.5 px-4 text-left font-bold text-[11px] text-zinc-500 dark:text-zinc-400 uppercase tracking-wider cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-800/50\">" .
                    ucfirst(str_replace('_', ' ', $field->name)) . "</th>";
            } else {
                $tableHeader = $field->getTableHeader();
                // Update to support dark mode & zinc palette
                $tableHeader = str_replace(
                    ['class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"', 'text-gray-500', 'text-gray-300'],
                    ['class="py-3.5 px-4 text-left font-bold text-[11px] text-zinc-500 dark:text-zinc-400 uppercase tracking-wider"', 'text-zinc-500 dark:text-zinc-400', 'text-zinc-400'],
                    $tableHeader
                );
                $headers[] = "                            " . $tableHeader;
            }
        }

        return implode("\n", $headers);
    }

    public function getTableCells(): string
    {
        $cells = [];
        $modelVar = $this->commandData->modelNameCamel;
        $timestampFields = ['created_at', 'updated_at', 'deleted_at'];

        // Always add ID column first
        $cells[] = "                                <td class=\"py-3.5 px-4 whitespace-nowrap text-xs font-medium text-zinc-800 dark:text-zinc-200\">{{\$" . $modelVar . "->id}}</td>";

        foreach ($this->commandData->fields as $field) {
            // Skip timestamp fields from table cells
            if (in_array($field->name, $timestampFields)) {
                continue;
            }

            // Handle Tagify fields (tags) - parse JSON and display comma-separated values
            // Also handle fields with 'keyword' in name (like meta_keywords)
            if ($field->htmlType === 'tags' || stripos($field->name, 'keyword') !== false) {
                $tableCell = "<td class=\"py-3.5 px-4 whitespace-nowrap text-xs text-zinc-800 dark:text-zinc-200\">";
                $tableCell .= "@php\n";
                $tableCell .= "                                            \$keywords = \$" . $modelVar . "->{$field->name} ?? null;\n";
                $tableCell .= "                                            if (\$keywords) {\n";
                $tableCell .= "                                                \$decoded = json_decode(\$keywords, true);\n";
                $tableCell .= "                                                if (is_array(\$decoded) && !empty(\$decoded)) {\n";
                $tableCell .= "                                                    \$values = [];\n";
                $tableCell .= "                                                    foreach (\$decoded as \$item) {\n";
                $tableCell .= "                                                        if (is_array(\$item) && isset(\$item['value'])) {\n";
                $tableCell .= "                                                            \$values[] = \$item['value'];\n";
                $tableCell .= "                                                        } elseif (is_string(\$item)) {\n";
                $tableCell .= "                                                            \$values[] = \$item;\n";
                $tableCell .= "                                                        }\n";
                $tableCell .= "                                                    }\n";
                $tableCell .= "                                                    echo e(implode(', ', \$values));\n";
                $tableCell .= "                                                } else {\n";
                $tableCell .= "                                                    echo e(\$keywords);\n";
                $tableCell .= "                                                }\n";
                $tableCell .= "                                            }\n";
                $tableCell .= "                                        @endphp";
                $tableCell .= "</td>";
            }
            // Handle TinyMCE fields (textarea) - strip HTML and limit to 100 chars
            elseif ($field->htmlType === 'textarea') {
                $tableCell = "<td class=\"py-3.5 px-4 whitespace-nowrap text-xs text-zinc-800 dark:text-zinc-200\">";
                $tableCell .= "@if(\$" . $modelVar . "->{$field->name})\n";
                $tableCell .= "                                        @php\n";
                $tableCell .= "                                            \$text = strip_tags(\$" . $modelVar . "->{$field->name});\n";
                $tableCell .= "                                            \$text = mb_strlen(\$text) > 100 ? mb_substr(\$text, 0, 100) . '...' : \$text;\n";
                $tableCell .= "                                            echo e(\$text);\n";
                $tableCell .= "                                        @endphp\n";
                $tableCell .= "                                    @endif";
                $tableCell .= "</td>";
            }
            // Handle boolean/checkbox fields - display as modern pill badges
            elseif ($field->htmlType === 'checkbox' || $field->dbType === 'boolean') {
                $tableCell = "<td class=\"py-3.5 px-4 whitespace-nowrap text-xs text-center\">";
                $tableCell .= "@if(\$" . $modelVar . "->{$field->name})\n";
                $tableCell .= "                                        <span class=\"inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60\"><span class=\"w-1.5 h-1.5 rounded-full bg-emerald-500\"></span>Yes</span>\n";
                $tableCell .= "                                    @else\n";
                $tableCell .= "                                        <span class=\"inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700\"><span class=\"w-1.5 h-1.5 rounded-full bg-zinc-400\"></span>No</span>\n";
                $tableCell .= "                                    @endif";
                $tableCell .= "</td>";
            }
            // Handle image/file fields - display as image
            elseif (in_array($field->htmlType, ['file', 'image'])) {
                $tableCell = "<td class=\"py-3.5 px-4 whitespace-nowrap text-xs text-center\">";
                $tableCell .= "@if(\$" . $modelVar . "->{$field->name})\n";
                $tableCell .= "                                        @php\n";
                $tableCell .= "                                            \$fileUrl = \App\Services\FileUploadService::getFileUrl(\$" . $modelVar . "->{$field->name});\n";
                $tableCell .= "                                        @endphp\n";
                $tableCell .= "                                        @if(\$fileUrl)\n";
                $tableCell .= "                                            <img src=\"{{ \$fileUrl }}\" alt=\"{{\$" . $modelVar . "->{$field->name}}}\" class=\"h-10 w-10 object-cover rounded-lg border border-zinc-200/80 dark:border-zinc-700 mx-auto\" onerror=\"this.style.display='none'\">\n";
                $tableCell .= "                                        @endif\n";
                $tableCell .= "                                    @endif";
                $tableCell .= "</td>";
            }
            // Default behavior for other fields
            else {
                $tableCell = $field->getTableCell();
                // Replace $item with the correct model variable name
                $tableCell = str_replace('$item', '$' . $modelVar, $tableCell);
                // Update to support dark mode & zinc palette
                $tableCell = str_replace(
                    ['class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"', 'text-gray-900', 'text-gray-500'],
                    ['class="py-3.5 px-4 whitespace-nowrap text-xs text-zinc-800 dark:text-zinc-200"', 'text-zinc-800 dark:text-zinc-200', 'text-zinc-500 dark:text-zinc-400'],
                    $tableCell
                );
            }

            $cells[] = "                                " . $tableCell;
        }

        return implode("\n", $cells);
    }

    public function getShowFields(): string
    {
        $fields = [];
        $modelVar = $this->commandData->modelNameCamel;
        $timestampFields = ['created_at', 'updated_at', 'deleted_at'];

        foreach ($this->commandData->fields as $field) {
            // Skip timestamp fields since they're hardcoded at the bottom
            if (in_array($field->name, $timestampFields)) {
                continue;
            }

            $fieldLabel = ucfirst(str_replace('_', ' ', $field->name));

            $fields[] = "                    <div class=\"lg:px-6 px-4 lg:py-4 py-3 flex flex-col lg:flex-row lg:items-center hover:bg-zinc-50/80 dark:hover:bg-zinc-800/50 transition-colors\">";
            $fields[] = "                        <dt class=\"lg:w-1/3 text-xs font-semibold text-zinc-500 dark:text-zinc-400\">";
            $fields[] = "                            {$fieldLabel}";
            $fields[] = "                        </dt>";
            $fields[] = "                        <dd class=\"mt-1 lg:mt-0 lg:w-2/3 text-xs font-medium text-zinc-800 dark:text-zinc-200\">";

            // Logic to render field value based on type
            if ($field->htmlType === 'tags' || stripos($field->name, 'keyword') !== false) {
                $fields[] = "                        @php";
                $fields[] = "                            \$keywords = \${$modelVar}->{$field->name} ?? null;";
                $fields[] = "                            if (\$keywords) {";
                $fields[] = "                                \$decoded = json_decode(\$keywords, true);";
                $fields[] = "                                if (is_array(\$decoded) && !empty(\$decoded)) {";
                $fields[] = "                                    \$values = [];";
                $fields[] = "                                    foreach (\$decoded as \$item) {";
                $fields[] = "                                        if (is_array(\$item) && isset(\$item['value'])) {";
                $fields[] = "                                            \$values[] = \$item['value'];";
                $fields[] = "                                        } elseif (is_string(\$item)) {";
                $fields[] = "                                            \$values[] = \$item;";
                $fields[] = "                                        }";
                $fields[] = "                                    }";
                $fields[] = "                                    echo implode(', ', \$values);";
                $fields[] = "                                } else {";
                $fields[] = "                                    echo \$keywords;";
                $fields[] = "                                }";
                $fields[] = "                            } else {";
                $fields[] = "                                echo 'N/A';";
                $fields[] = "                            }";
                $fields[] = "                        @endphp";
            } elseif ($field->htmlType === 'checkbox' || $field->dbType === 'boolean') {
                $fields[] = "                        @if(\${$modelVar}->{$field->name})";
                $fields[] = "                            <span class=\"inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-800/60\"><span class=\"w-1.5 h-1.5 rounded-full bg-emerald-500\"></span>Yes</span>";
                $fields[] = "                        @else";
                $fields[] = "                            <span class=\"inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700\"><span class=\"w-1.5 h-1.5 rounded-full bg-zinc-400\"></span>No</span>";
                $fields[] = "                        @endif";
            } elseif (in_array($field->htmlType, ['file', 'image'])) {
                $fields[] = "                        @if(\${$modelVar}->{$field->name})";
                $fields[] = "                            @php";
                $fields[] = "                                \$fileUrl = \App\Services\FileUploadService::getFileUrl(\${$modelVar}->{$field->name});";
                $fields[] = "                            @endphp";
                $fields[] = "                            @if(\$fileUrl)";
                $fields[] = "                                <div class=\"flex items-center justify-start w-full py-2\">";
                $fields[] = "                                    <img src=\"{{ \$fileUrl }}\" alt=\"{$fieldLabel}\" class=\"max-w-xs max-h-64 object-contain rounded-xl border border-zinc-200/80 dark:border-zinc-700 shadow-sm\">";
                $fields[] = "                                </div>";
                $fields[] = "                            @else";
                $fields[] = "                                N/A";
                $fields[] = "                            @endif";
                $fields[] = "                        @else";
                $fields[] = "                            N/A";
                $fields[] = "                        @endif";
            } else {
                $fields[] = "                        {{ \${$modelVar}->{$field->name} ?? 'N/A' }}";
            }

            $fields[] = "                        </dd>";
            $fields[] = "                    </div>";
        }

        return implode("\n", $fields);
    }

    public function getFieldCount(): int
    {
        $timestampFields = ['created_at', 'updated_at', 'deleted_at'];
        $fieldCount = 0;

        // Count ID column
        $fieldCount += 1;

        // Count non-timestamp fields
        foreach ($this->commandData->fields as $field) {
            if (!in_array($field->name, $timestampFields)) {
                $fieldCount += 1;
            }
        }

        // Count Actions column
        $fieldCount += 1;

        return $fieldCount;
    }
}
