<?php

namespace Urimz\PatternPro\Console\Commands\ProviderBindings;

use Urimz\PatternPro\Console\Commands\Content\AppServiceProviderContent;
use Illuminate\Support\Facades\File;

class AppServiceProviderBinding
{
    public static function binding($moduleName, $repositoryName, $repositoryInterfaceName): void
    {

        $appServiceProviderContent = AppServiceProviderContent::get($moduleName);


        $appServiceProviderPath = app_path("Modules/{$moduleName}/Providers/AppServiceProvider.php");
        $repositoryBinding = "\$this->app->bind({$repositoryInterfaceName}::class, {$repositoryName}::class);";

        $repositoryImport = "use App\\Modules\\{$moduleName}\\Repositories\\{$repositoryName};";
        $interfaceImport = "use App\\Modules\\{$moduleName}\\Repositories\\Contracts\\{$repositoryInterfaceName};";

        if (!file_exists($appServiceProviderPath)) {
            File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Providers"));
            File::put($appServiceProviderPath, $appServiceProviderContent);
        }

        $appServiceProviderContent = File::get($appServiceProviderPath);

        if (strpos($appServiceProviderContent, $repositoryBinding) === false) {
            // Insert the binding in the register method
            $pattern = '/public function register\(\): void\s*\{\s*/';
            $replacement = "$0{$repositoryBinding}\n        ";
            $appServiceProviderContent = preg_replace($pattern, $replacement, $appServiceProviderContent);

            // Check if the repository import already exists
            if (strpos($appServiceProviderContent, $repositoryImport) === false) {
                // Add the repository import
                $appServiceProviderContent = str_replace(
                    'use Illuminate\Support\ServiceProvider;',
                    "use Illuminate\Support\ServiceProvider;\n{$repositoryImport}",
                    $appServiceProviderContent
                );
            }

            // Check if the interface import already exists
            if (strpos($appServiceProviderContent, $interfaceImport) === false) {
                // Add the interface import
                $appServiceProviderContent = str_replace(
                    'use Illuminate\Support\ServiceProvider;',
                    "use Illuminate\Support\ServiceProvider;\n{$interfaceImport}",
                    $appServiceProviderContent
                );
            }

            // Save the updated content
            File::put($appServiceProviderPath, $appServiceProviderContent);
        }
    }
}
