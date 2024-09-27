<?php

namespace Urimz\PatternPro\Console\Commands;

use Urimz\PatternPro\Console\Commands\Content\BaseRepositoryContent;
use Urimz\PatternPro\Console\Commands\Content\RepositoryInterfaceContent;
use Urimz\PatternPro\Console\Commands\ProviderBindings\AppServiceProviderBinding;
use Urimz\PatternPro\Console\Commands\ProviderBindings\PolicyServiceProviderBinding;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Urimz\PatternPro\Console\Commands\Content\ModelContent;
use Urimz\PatternPro\Console\Commands\Content\ControllerContent;
use Urimz\PatternPro\Console\Commands\Content\StoreRequestContent;
use Urimz\PatternPro\Console\Commands\Content\UpdateRequestContent;
use Urimz\PatternPro\Console\Commands\Content\ResourceContent;
use Urimz\PatternPro\Console\Commands\Content\PolicyContent;
use Urimz\PatternPro\Console\Commands\Content\RepositoryContent;
use Urimz\PatternPro\Console\Commands\Content\ServiceContent;

class MakeModuleModelAll extends Command
{
    protected $signature = 'make:module-model {moduleName} {modelName}';

    protected $description = 'Make a model on a module';

    public function handle()
    {
        $moduleName = $this->argument('moduleName');
        $modelName = $this->argument('modelName');
        $controllerName = $modelName . 'Controller';
        $storeRequestName = 'Store' . $modelName . 'Request';
        $updateRequestName = 'Update' . $modelName . 'Request';
        $resourceName = $modelName . 'Resource';
        $policyName = $modelName . 'Policy';
        $repositoryName = $modelName . 'Repository';
        $repositoryInterfaceName = $modelName . 'RepositoryInterface';
        $serviceName = $modelName . 'Service';

        $modelPath = app_path("Modules/{$moduleName}/Models/{$modelName}.php");
        $controllerPath = app_path("Modules/{$moduleName}/Http/Controllers/{$controllerName}.php");
        $storeRequestPath = app_path("Modules/{$moduleName}/Http/Requests/{$storeRequestName}.php");
        $updateRequestPath = app_path("Modules/{$moduleName}/Http/Requests/{$updateRequestName}.php");
        $resourcePath = app_path("Modules/{$moduleName}/Http/Resources/{$resourceName}.php");
        $policyPath = app_path("Modules/{$moduleName}/Policies/{$policyName}.php");
        $basedRepositoryPath = app_path("Modules/Shared/Repositories/BasedRepository.php");
        $repositoryPath = app_path("Modules/{$moduleName}/Repositories/{$repositoryName}.php");
        $repositoryInterfacePath = app_path("Modules/{$moduleName}/Repositories/Contracts/{$repositoryInterfaceName}.php");
        $servicePath = app_path("Modules/{$moduleName}/Services/{$serviceName}.php");

        $isUsingRepositoryPattern = config('pattern-pro.include_repository_pattern') ?? true;
        $isUsingServicePattern = config('pattern-pro.include_service_pattern') ?? true;

        // Check if files already exist
        if (File::exists($modelPath)) {
            $this->error('Model already exists!');
            return;
        }

        if (File::exists($controllerPath)) {
            $this->error('Controller already exists!');
            return;
        }

        if (File::exists($storeRequestPath)) {
            $this->error('Store request already exists!');
            return;
        }

        if (File::exists($updateRequestPath)) {
            $this->error('Update request  already exists!');
            return;
        }

        if (File::exists($resourcePath)) {
            $this->error('Resource  already exists!');
            return;
        }

        if (File::exists($policyPath)) {
            $this->error('Policy already exists!');
            return;
        }

        if (File::exists($repositoryPath) and $isUsingRepositoryPattern) {
            $this->error('Repository or Interface already exists!');
            return;
        }

        if (File::exists($repositoryInterfacePath) and $isUsingRepositoryPattern) {
            $this->error('Interface of Repository already exists!');
            return;
        }

        if (File::exists($servicePath) and $isUsingServicePattern) {
            $this->error('Service already exists!');
            return;
        }


        // Generate content for different files
        $modelContent = ModelContent::get($moduleName, $modelName);
        $controllerContent = ControllerContent::get($moduleName, $modelName, $storeRequestName, $updateRequestName, $serviceName);
        $storeRequestContent = StoreRequestContent::get($moduleName, $storeRequestName);
        $updateRequestContent = UpdateRequestContent::get($moduleName, $updateRequestName);
        $resourceContent = ResourceContent::get($moduleName, $resourceName);
        $policyContent = PolicyContent::get($moduleName, $policyName, $modelName);
        if ($isUsingRepositoryPattern){
            $baseRepositoryContent = BaseRepositoryContent::get();
            $repositoryContent = RepositoryContent::get($moduleName, $repositoryName, $repositoryInterfaceName, $modelName);
            $repositoryInterfaceContent = RepositoryInterfaceContent::get($moduleName, $repositoryInterfaceName);
        }
        if ($isUsingServicePattern) {
            $serviceContent = ServiceContent::get($moduleName, $serviceName, $repositoryInterfaceName);
        }
        if (!File::exists($basedRepositoryPath) and $isUsingRepositoryPattern) {
            File::ensureDirectoryExists(app_path("Modules/Shared/Repositories"));
            File::put($basedRepositoryPath, $baseRepositoryContent);
        }

        // Create the files
        File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Models"));
        File::put($modelPath, $modelContent);

        File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Http/Controllers"));
        File::put($controllerPath, $controllerContent);

        File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Http/Requests"));
        File::put($storeRequestPath, $storeRequestContent);

        File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Http/Requests"));
        File::put($updateRequestPath, $updateRequestContent);

        File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Http/Resources"));
        File::put($resourcePath, $resourceContent);

        File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Policies"));
        File::put($policyPath, $policyContent);

        if ($isUsingRepositoryPattern){
            File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Repositories"));
            File::put($repositoryPath, $repositoryContent);
        }

        if ($isUsingRepositoryPattern) {
            File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Repositories/Contracts"));
            File::put($repositoryInterfacePath, $repositoryInterfaceContent);
        }

        if ($isUsingServicePattern) {
            File::ensureDirectoryExists(app_path("Modules/{$moduleName}/Services"));
            File::put($servicePath, $serviceContent);
        }

        $this->info('Successfully files created.');

        AppServiceProviderBinding::binding($moduleName, $repositoryName, $repositoryInterfaceName);
        $this->info('AppServiceProvider bindings created successfully.');

        PolicyServiceProviderBinding::binding($moduleName, $modelName, $policyName);
        $this->info('PolicyServiceProvider bindings created successfully.');
    }
}
