<?php

namespace Urimz\PatternPro\Console\Commands\ProviderBindings;

use Urimz\PatternPro\Console\Commands\Content\PolicyServiceProviderContent;
use Illuminate\Support\Facades\File;

class PolicyServiceProviderBinding
{
    public static function binding($moduleName, $modelName, $policyName): void
    {
        $policyServiceProviderContent = PolicyServiceProviderContent::get($moduleName);

        $policyServiceProviderPath = app_path("Modules/{$moduleName}/Providers/PolicyServiceProvider.php");
        $policyBinding = "{$modelName}::class => {$policyName}::class,";

        $modelImport = "use App\\Modules\\{$moduleName}\\Models\\{$modelName};";
        $policyImport = "use App\\Modules\\{$moduleName}\\Policies\\{$policyName};";

        if (!file_exists($policyServiceProviderPath)) {
            File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Providers"));
            File::put($policyServiceProviderPath, $policyServiceProviderContent);
        }

        $policyServiceProviderContent = File::get($policyServiceProviderPath);

        if (strpos($policyServiceProviderContent, $policyBinding) === false) {
            // Insert policy binding in the policies array
            $pattern = '/protected \$policies = \[\s*/';
            $replacement = "$0{$policyBinding}\n        ";
            $policyServiceProviderContent = preg_replace($pattern, $replacement, $policyServiceProviderContent);
        }

        if (strpos($policyServiceProviderContent, $modelImport) === false) {
            $policyServiceProviderContent = str_replace(
                'use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;',
                "use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;\n{$modelImport}",
                $policyServiceProviderContent
            );
        }

        if (strpos($policyServiceProviderContent, $policyImport) === false) {
            $policyServiceProviderContent = str_replace(
                'use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;',
                "use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;\n{$policyImport}",
                $policyServiceProviderContent
            );
        }

        File::put($policyServiceProviderPath, $policyServiceProviderContent);
    }
}
