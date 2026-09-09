<?php

namespace App\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RevertScaffoldCommand extends Command
{
    protected $signature = 'revert:scaffold
                            {model : The name of the model to revert}
                            {--force : Skip confirmation prompts}';

    protected $description = 'Revert/Remove generated scaffold files and database entries';

    public function handle()
    {
        $rawInput = trim((string) $this->argument('model'));
        $force = $this->option('force');

        if ($rawInput && !preg_match('/^[A-Za-z][A-Za-z0-9_]*$/', $rawInput)) {
            $this->error("Invalid model name '{$rawInput}'. Model name must be alphanumeric and start with a letter.");
            return 1;
        }

        $studlySingular = Str::studly(Str::singular($rawInput));
        $studlyPlural   = Str::studly(Str::plural($rawInput));
        $studlyRaw      = Str::studly($rawInput);

        // Candidates for class names (Model, Controller, Table, Policy, Request, etc.)
        $candidateModels = array_values(array_unique(array_filter([
            $studlySingular,
            $studlyPlural,
            $studlyRaw,
        ])));

        // Candidates for table/module/folder names
        $candidateTables = array_values(array_unique(array_filter([
            Str::snake(Str::plural($studlySingular)),
            Str::snake($studlySingular),
            Str::snake(Str::plural($rawInput)),
            Str::snake($rawInput),
            Str::kebab(Str::plural($studlySingular)),
            Str::kebab($studlySingular),
            Str::kebab(Str::plural($rawInput)),
            Str::kebab($rawInput),
        ])));

        $this->info("Reverting scaffold for {$studlySingular}...");

        // Confirm deletion
        if (!$force && !$this->confirm("Are you sure you want to remove all files for {$studlySingular}? This cannot be undone!", false)) {
            $this->info('Revert cancelled.');
            return 0;
        }

        $filesDeleted = [];
        $errors = [];

        // 1. Delete Model
        foreach ($candidateModels as $m) {
            $modelPath = app_path("Models/{$m}.php");
            if (file_exists($modelPath)) {
                if (unlink($modelPath)) {
                    $filesDeleted[] = "Model: {$modelPath}";
                } else {
                    $errors[] = "Failed to delete Model: {$modelPath}";
                }
            }
        }

        // 2. Delete Controller & API Controller
        foreach ($candidateModels as $m) {
            $controllerPath = app_path("Http/Controllers/{$m}Controller.php");
            if (file_exists($controllerPath)) {
                if (unlink($controllerPath)) {
                    $filesDeleted[] = "Controller: {$controllerPath}";
                } else {
                    $errors[] = "Failed to delete Controller: {$controllerPath}";
                }
            }

            $apiControllerPath = app_path("Http/Controllers/Api/{$m}ApiController.php");
            if (file_exists($apiControllerPath)) {
                if (unlink($apiControllerPath)) {
                    $filesDeleted[] = "API Controller: {$apiControllerPath}";
                } else {
                    $errors[] = "Failed to delete API Controller: {$apiControllerPath}";
                }
            }
        }

        // 3. Delete Requests
        foreach ($candidateModels as $m) {
            $createRequestPath = app_path("Http/Requests/Create{$m}Request.php");
            $updateRequestPath = app_path("Http/Requests/Update{$m}Request.php");

            if (file_exists($createRequestPath)) {
                if (unlink($createRequestPath)) {
                    $filesDeleted[] = "CreateRequest: {$createRequestPath}";
                } else {
                    $errors[] = "Failed to delete CreateRequest: {$createRequestPath}";
                }
            }

            if (file_exists($updateRequestPath)) {
                if (unlink($updateRequestPath)) {
                    $filesDeleted[] = "UpdateRequest: {$updateRequestPath}";
                } else {
                    $errors[] = "Failed to delete UpdateRequest: {$updateRequestPath}";
                }
            }
        }

        // 4. Delete Views
        foreach ($candidateTables as $viewFolder) {
            $viewsPath = resource_path("views/admin/{$viewFolder}");
            if (is_dir($viewsPath)) {
                if ($this->deleteDirectory($viewsPath)) {
                    $filesDeleted[] = "Views: {$viewsPath}";
                } else {
                    $errors[] = "Failed to delete Views: {$viewsPath}";
                }
            }
        }

        // 5. Delete Seeder
        foreach ($candidateModels as $m) {
            $seederPath = database_path("seeders/{$m}Seeder.php");
            if (file_exists($seederPath)) {
                if (unlink($seederPath)) {
                    $filesDeleted[] = "Seeder: {$seederPath}";
                } else {
                    $errors[] = "Failed to delete Seeder: {$seederPath}";
                }
            }
        }

        // 6. Delete Factory
        foreach ($candidateModels as $m) {
            $factoryPath = database_path("factories/{$m}Factory.php");
            if (file_exists($factoryPath)) {
                if (unlink($factoryPath)) {
                    $filesDeleted[] = "Factory: {$factoryPath}";
                } else {
                    $errors[] = "Failed to delete Factory: {$factoryPath}";
                }
            }
        }

        // 7. Delete Livewire Table (PowerGrid) & DataTable
        foreach ($candidateModels as $m) {
            $livewireTablePath = app_path("Livewire/Tables/{$m}Table.php");
            if (file_exists($livewireTablePath)) {
                if (unlink($livewireTablePath)) {
                    $filesDeleted[] = "Livewire Table: {$livewireTablePath}";
                } else {
                    $errors[] = "Failed to delete Livewire Table: {$livewireTablePath}";
                }
            }

            $dataTablePath = app_path("DataTables/{$m}DataTable.php");
            if (file_exists($dataTablePath)) {
                if (unlink($dataTablePath)) {
                    $filesDeleted[] = "DataTable: {$dataTablePath}";
                } else {
                    $errors[] = "Failed to delete DataTable: {$dataTablePath}";
                }
            }
        }

        // 8. Delete Test
        foreach ($candidateModels as $m) {
            $testPath = base_path("tests/Feature/{$m}Test.php");
            if (file_exists($testPath)) {
                if (unlink($testPath)) {
                    $filesDeleted[] = "Test: {$testPath}";
                } else {
                    $errors[] = "Failed to delete Test: {$testPath}";
                }
            }
        }

        // 8b. Delete API Resource
        foreach ($candidateModels as $m) {
            $resourcePath = app_path("Http/Resources/{$m}Resource.php");
            if (file_exists($resourcePath)) {
                if (unlink($resourcePath)) {
                    $filesDeleted[] = "API Resource: {$resourcePath}";
                } else {
                    $errors[] = "Failed to delete API Resource: {$resourcePath}";
                }
            }
        }

        // 8c. Delete Policy
        foreach ($candidateModels as $m) {
            $policyPath = app_path("Policies/{$m}Policy.php");
            if (file_exists($policyPath)) {
                if (unlink($policyPath)) {
                    $filesDeleted[] = "Policy: {$policyPath}";
                } else {
                    $errors[] = "Failed to delete Policy: {$policyPath}";
                }
            }
        }

        // 9. Find and optionally delete Migration
        $migrationFiles = [];
        foreach ($candidateTables as $t) {
            $found = glob(database_path("migrations/*_create_{$t}_table.php"));
            if (!empty($found)) {
                $migrationFiles = array_merge($migrationFiles, $found);
            }
        }
        $migrationFiles = array_unique($migrationFiles);

        if (!empty($migrationFiles)) {
            if ($force || $this->confirm("Found migration file(s). Do you want to delete them?", false)) {
                foreach ($migrationFiles as $migrationFile) {
                    if (unlink($migrationFile)) {
                        $filesDeleted[] = "Migration: {$migrationFile}";
                    } else {
                        $errors[] = "Failed to delete Migration: {$migrationFile}";
                    }
                }
            } else {
                $this->info("Skipping migration deletion.");
            }
        }

        // 10. Remove Routes
        $this->removeRoutes($candidateModels, $candidateTables);
        $this->removeApiRoutes($candidateModels, $candidateTables);

        // 11. Remove Menu entries from config
        $this->removeConfigMenu($candidateTables);

        // 12. Remove Permissions from database
        $hasPermissionsTable = false;
        try {
            $hasPermissionsTable = Schema::hasTable('permissions');
        } catch (\Exception $e) {
            $hasPermissionsTable = false;
        }

        if ($hasPermissionsTable) {
            $deletedPermissions = \App\Models\Permission::whereIn('module', $candidateTables)->delete();
            if ($deletedPermissions > 0) {
                $filesDeleted[] = "Database: Deleted {$deletedPermissions} permission entries";
            }
        }
        $this->removePermissionsFromSeeder($candidateTables);

        // Clean up empty directories
        foreach ([app_path('Http/Requests'), app_path('Policies'), app_path('Http/Resources'), app_path('Http/Controllers/Api')] as $dir) {
            if (is_dir($dir)) {
                $contents = array_diff(scandir($dir), ['.', '..']);
                if (empty($contents)) {
                    @rmdir($dir);
                }
            }
        }

        // 13. Regenerate autoloader
        $this->regenerateAutoloader();

        // Display results
        if (!empty($filesDeleted)) {
            $this->info("\n✓ Successfully deleted:");
            foreach ($filesDeleted as $file) {
                $this->line("  - {$file}");
            }
        }

        if (!empty($errors)) {
            $this->error("\n✗ Errors:");
            foreach ($errors as $error) {
                $this->line("  - {$error}");
            }
        }

        if (empty($filesDeleted) && empty($errors)) {
            $this->warn("No files found for {$studlySingular}. Scaffold may not exist.");
        } else {
            $this->info("\n✓ Scaffold revert completed!");
        }

        return 0;
    }

    private function removePermissionsFromSeeder(array $candidateTables): void
    {
        $seederPath = base_path('database/seeders/RolePermissionSeeder.php');
        if (!file_exists($seederPath)) return;

        $content = file_get_contents($seederPath);

        foreach ($candidateTables as $moduleName) {
            $pattern = "/'module'\s*=>\s*'" . preg_quote($moduleName, '/') . "'/";
            $content = $this->removeArrayEntryContaining($content, $pattern);
        }

        file_put_contents($seederPath, $content);
    }

    private function removeConfigMenu(array $candidateTables): void
    {
        $configPath = base_path('config/menu.php');
        if (!file_exists($configPath)) return;

        $content = file_get_contents($configPath);

        foreach ($candidateTables as $t) {
            $routeName = 'admin.' . $t . '.index';
            $pattern = "/'route'\s*=>\s*'" . preg_quote($routeName, '/') . "'/";
            $content = $this->removeArrayEntryContaining($content, $pattern);
        }

        file_put_contents($configPath, $content);
    }

    private function removeArrayEntryContaining(string $content, string $searchPattern): string
    {
        while (preg_match($searchPattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
            $matchPos = $matches[0][1];

            $depth = 0;
            $startPos = -1;
            for ($i = $matchPos; $i >= 0; $i--) {
                $char = $content[$i];
                if ($char === ']') {
                    $depth++;
                } elseif ($char === '[') {
                    if ($depth === 0) {
                        $startPos = $i;
                        break;
                    }
                    $depth--;
                }
            }

            if ($startPos === -1) {
                break;
            }

            $depth = 0;
            $endPos = -1;
            $len = strlen($content);
            for ($i = $startPos; $i < $len; $i++) {
                $char = $content[$i];
                if ($char === '[') {
                    $depth++;
                } elseif ($char === ']') {
                    $depth--;
                    if ($depth === 0) {
                        $endPos = $i;
                        break;
                    }
                }
            }

            if ($endPos === -1) {
                break;
            }

            $endPosIndex = $endPos + 1;
            if ($endPosIndex < $len && $content[$endPosIndex] === ',') {
                $endPosIndex++;
            }
            while ($endPosIndex < $len && ($content[$endPosIndex] === "\r" || $content[$endPosIndex] === "\n")) {
                $endPosIndex++;
            }

            while ($startPos > 0 && ($content[$startPos - 1] === ' ' || $content[$startPos - 1] === "\t")) {
                $startPos--;
            }

            $content = substr($content, 0, $startPos) . substr($content, $endPosIndex);
        }

        return $content;
    }

    private function removeRoutes(array $candidateModels, array $candidateTables): void
    {
        $webRoutesPath = base_path('routes/web.php');
        if (!file_exists($webRoutesPath)) {
            return;
        }

        $currentContent = file_get_contents($webRoutesPath);

        // Remove use statements for each candidate controller
        foreach ($candidateModels as $m) {
            $controllerName = "{$m}Controller";
            $controllerImport = "use App\\Http\\Controllers\\{$controllerName};";
            $currentContent = str_replace("\n{$controllerImport}", '', $currentContent);
            $currentContent = str_replace("{$controllerImport}\n", '', $currentContent);
            $currentContent = str_replace($controllerImport, '', $currentContent);
        }

        // Build list of comments to identify route blocks
        $commentLines = [];
        foreach ($candidateModels as $m) {
            $commentLines[] = "// " . Str::headline($m) . " routes";
            $commentLines[] = "// " . Str::headline(Str::plural($m)) . " routes";
            $commentLines[] = "// " . Str::title(str_replace('_', ' ', Str::snake($m))) . " routes";
        }
        foreach ($candidateTables as $t) {
            $commentLines[] = "// " . Str::headline($t) . " routes";
            $commentLines[] = "// " . Str::title(str_replace('_', ' ', $t)) . " routes";
        }
        $commentLines = array_unique($commentLines);

        $lines = explode("\n", $currentContent);
        $newLines = [];
        $inRouteBlock = false;

        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];
            $trimmed = trim($line);

            // Check if comment line matches
            $isComment = false;
            foreach ($commentLines as $c) {
                if (stripos($trimmed, $c) !== false) {
                    $isComment = true;
                    break;
                }
            }

            if ($isComment) {
                $inRouteBlock = true;
                continue; // Skip comment line
            }

            if ($inRouteBlock) {
                // Check if this line is a route for this model
                $isRoute = false;
                foreach ($candidateModels as $m) {
                    if (str_contains($line, "{$m}Controller::class")) {
                        $isRoute = true;
                        break;
                    }
                }
                if (!$isRoute) {
                    foreach ($candidateTables as $t) {
                        if (
                            str_contains($line, "'{$t}/") ||
                            str_contains($line, "\"{$t}/") ||
                            str_contains($line, "'{$t}'") ||
                            str_contains($line, "\"{$t}\"")
                        ) {
                            $isRoute = true;
                            break;
                        }
                    }
                }

                if ($isRoute) {
                    continue; // Skip route line
                }

                // If we encounter another comment, route, or empty line, end block
                if ($trimmed === '' || str_starts_with($trimmed, '// ') || str_starts_with($trimmed, 'Route::')) {
                    $inRouteBlock = false;
                    if ($trimmed === '') {
                        if (isset($lines[$i + 1]) && trim($lines[$i + 1]) !== '') {
                            $newLines[] = $line;
                        }
                        continue;
                    }
                }
            }

            // Also check individual line outside route block
            $isOrphan = false;
            foreach ($candidateModels as $m) {
                if (str_contains($line, "{$m}Controller::class")) {
                    $isOrphan = true;
                    break;
                }
            }
            if ($isOrphan) {
                continue;
            }

            $newLines[] = $line;
        }

        $newContent = implode("\n", $newLines);
        $newContent = preg_replace("/\n{3,}/", "\n\n", $newContent);

        file_put_contents($webRoutesPath, $newContent);
    }

    private function removeApiRoutes(array $candidateModels, array $candidateTables): void
    {
        $apiRoutesPath = base_path('routes/api.php');
        if (!file_exists($apiRoutesPath)) {
            return;
        }

        $currentContent = file_get_contents($apiRoutesPath);

        foreach ($candidateModels as $m) {
            $controllerName = "{$m}ApiController";
            $controllerImport = "use App\\Http\\Controllers\\Api\\{$controllerName};";
            $currentContent = str_replace("\n{$controllerImport}", '', $currentContent);
            $currentContent = str_replace("{$controllerImport}\n", '', $currentContent);
            $currentContent = str_replace($controllerImport, '', $currentContent);
        }

        $commentLines = [];
        foreach ($candidateModels as $m) {
            $commentLines[] = "// " . Str::headline($m) . " routes";
            $commentLines[] = "// " . Str::headline(Str::plural($m)) . " routes";
        }
        foreach ($candidateTables as $t) {
            $commentLines[] = "// " . Str::headline($t) . " routes";
        }
        $commentLines = array_unique($commentLines);

        $lines = explode("\n", $currentContent);
        $newLines = [];
        $inRouteBlock = false;

        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];
            $trimmed = trim($line);

            $isComment = false;
            foreach ($commentLines as $c) {
                if (stripos($trimmed, $c) !== false) {
                    $isComment = true;
                    break;
                }
            }

            if ($isComment) {
                $inRouteBlock = true;
                continue;
            }

            if ($inRouteBlock) {
                $isRoute = false;
                foreach ($candidateModels as $m) {
                    if (str_contains($line, "{$m}ApiController::class")) {
                        $isRoute = true;
                        break;
                    }
                }
                if (!$isRoute) {
                    foreach ($candidateTables as $t) {
                        if (str_contains($line, "'{$t}'") || str_contains($line, "\"{$t}\"")) {
                            $isRoute = true;
                            break;
                        }
                    }
                }

                if ($isRoute) {
                    continue;
                }

                if ($trimmed === '' || str_starts_with($trimmed, '// ') || str_starts_with($trimmed, 'Route::')) {
                    $inRouteBlock = false;
                    if ($trimmed === '') {
                        if (isset($lines[$i + 1]) && trim($lines[$i + 1]) !== '') {
                            $newLines[] = $line;
                        }
                        continue;
                    }
                }
            }

            $isOrphan = false;
            foreach ($candidateModels as $m) {
                if (str_contains($line, "{$m}ApiController::class")) {
                    $isOrphan = true;
                    break;
                }
            }
            if ($isOrphan) {
                continue;
            }

            $newLines[] = $line;
        }

        $newContent = implode("\n", $newLines);
        $newContent = preg_replace("/\n{3,}/", "\n\n", $newContent);

        file_put_contents($apiRoutesPath, $newContent);
    }

    private function regenerateAutoloader(): void
    {
        $this->info("Regenerating autoloader...");

        try {
            $this->call('config:clear');
            $this->call('route:clear');

            $command = 'composer dump-autoload --quiet';
            $exitCode = 0;
            $output = [];

            exec($command . ' 2>&1', $output, $exitCode);

            if ($exitCode === 0) {
                $this->info("✓ Autoloader regenerated successfully");
            } else {
                $this->warn("Composer dump-autoload returned exit code: {$exitCode}");
                $this->warn("You may need to run 'composer dump-autoload' manually.");
            }
        } catch (\Exception $e) {
            $this->warn("Could not regenerate autoloader automatically: " . $e->getMessage());
            $this->warn("Please run 'composer dump-autoload' manually.");
        }
    }

    private function deleteDirectory(string $dir): bool
    {
        if (!is_dir($dir)) {
            return false;
        }

        $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;

            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }

        return rmdir($dir);
    }
}
